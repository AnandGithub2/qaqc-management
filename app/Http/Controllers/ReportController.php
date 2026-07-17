<?php

namespace App\Http\Controllers;


use App\Models\Sample;
use App\Models\COA;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{


  public function index()
{
    $samples = Sample::with([
        'company',
        'product'
    ])->latest()->get();

    $companies = \App\Models\Company::orderBy('company_name')->get();

    $products = \App\Models\Product::orderBy('product_name')->get();

    $coaCount = COA::count();

    return view(
        'reports.index',
        compact(
            'samples',
            'companies',
            'products',
            'coaCount'
        )
    );
}



  public function sampleReport(Request $request)
{
    $samples = Sample::with([
        'company',
        'product'
    ])

    ->when($request->company_id,function($q) use($request){

        $q->where(
            'company_id',
            $request->company_id
        );

    })

    ->when($request->product_id,function($q) use($request){

        $q->where(
            'product_id',
            $request->product_id
        );

    })

    ->when($request->qa_status,function($q) use($request){

        $q->where(
            'qa_status',
            $request->qa_status
        );

    })

    ->when($request->from_date,function($q) use($request){

        $q->whereDate(
            'sample_date',
            '>=',
            $request->from_date
        );

    })

    ->when($request->to_date,function($q) use($request){

        $q->whereDate(
            'sample_date',
            '<=',
            $request->to_date
        );

    })

    ->latest()

    ->get();

    return view(
        'reports.sample',
        compact('samples')
    );
}

public function pdf(Request $request)
{
    $samples = Sample::with([
        'company',
        'product'
    ])

    ->when($request->company_id,function($q) use($request){

        $q->where('company_id',$request->company_id);

    })

    ->when($request->product_id,function($q) use($request){

        $q->where('product_id',$request->product_id);

    })

    ->when($request->qa_status,function($q) use($request){

        $q->where('qa_status',$request->qa_status);

    })

    ->when($request->from_date,function($q) use($request){

        $q->whereDate(
            'sample_date',
            '>=',
            $request->from_date
        );

    })

    ->when($request->to_date,function($q) use($request){

        $q->whereDate(
            'sample_date',
            '<=',
            $request->to_date
        );

    })

    ->latest()

    ->get();

    $pdf = Pdf::loadView(
        'reports.pdf',
        compact('samples')
    )->setPaper('a4','landscape');

    return $pdf->download('Sample_Report.pdf');
}

}