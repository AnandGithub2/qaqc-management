<?php

namespace App\Http\Controllers;


use App\Models\COA;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\COAMail;
class COAController extends Controller
{
public static function middleware(): array
{
    return [
        'permission:generate coa'
    ];
}
public function create($sample_id)
{

    $sample = Sample::with([
        'company',
        'product',
        'sampleTests.testParameter'
    ])
    ->findOrFail($sample_id);


    return view(
        'coa.show',
        compact('sample')
    );

}



  public function store(Request $request)
{

    $request->validate([

        'sample_id'=>'required',

        'remarks'=>'nullable'

    ]);


    COA::create([

        'sample_id'=>$request->sample_id,

        'coa_number'=>'COA-'.time(),

        'issue_date'=>now(),

        'prepared_by'=>Auth::user()->name,

        'approved_by'=>Auth::user()->name,

        'remarks'=>$request->remarks

    ]);


    return redirect()
    ->route('samples.index')
    ->with(
        'success',
        'COA Generated Successfully'
    );

}



public function generate(Sample $sample)
{

    $sample->load([
        'company',
        'product',
        'sampleTests.testParameter',
        'coa'
    ]);


    // Agar COA nahi bana hai to create karo

    if(!$sample->coa)
    {

        $coa = COA::create([

            'sample_id'=>$sample->id,

            'coa_number'=>'COA-'.date('Ymd').'-'.$sample->id,

            'issue_date'=>now(),

            'prepared_by'=>Auth::user()->name,

            'approved_by'=>Auth::user()->name,

            'remarks'=>'Generated Automatically'

        ]);


        $sample->setRelation('coa',$coa);

    }



    $pdf = Pdf::loadView(
        'coa.pdf',
        compact('sample')
    )
    ->setPaper('a4');


    return $pdf->download(
        $sample->coa->coa_number.'.pdf'
    );

}
public function index()
{

    $coas = COA::with([
        'sample.company',
        'sample.product'
    ])
    ->latest()
    ->get();


    return view(
        'coa.index',
        compact('coas')
    );

}


public function sendMail(Sample $sample)
{
    $sample->load([
        'company',
        'product',
        'sampleTests.testParameter',
        'coa'
    ]);

    Mail::to($sample->company->email)
        ->send(new COAMail($sample));

    return back()->with(
        'success',
        'COA Email Sent Successfully.'
    );
}
}