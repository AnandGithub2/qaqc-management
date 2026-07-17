<?php

namespace App\Http\Controllers;
use App\Services\ActivityLogService;
use App\Services\AuditTrailService;
use App\Models\Sample;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

class SampleController extends Controller
{

    public function index(Request $request)
{
    $search = $request->search;

    $samples = Sample::with([
        'company',
        'product'
    ])

    ->when($search, function ($query) use ($search) {

        $query->where('sample_number','like',"%{$search}%")
              ->orWhere('batch_number','like',"%{$search}%")
              ->orWhereHas('company', function($q) use ($search){
                    $q->where('company_name','like',"%{$search}%");
              })
              ->orWhereHas('product', function($q) use ($search){
                    $q->where('product_name','like',"%{$search}%");
              });

    })

    ->latest()

    ->paginate(10)

    ->withQueryString();

    return view(
        'samples.index',
        compact('samples','search')
    );
}


    public function create()
    {

        $companies = Company::all();

        $products = Product::all();


        return view('samples.create',
        compact('companies','products'));

    }



    public function store(Request $request)
    {

        $request->validate([

            'company_id'=>'required',

           'product_id'=>'required|exists:products,id',

            'sample_number'=>'required|unique:samples',

            'batch_number'=>'required',
       
            'sample_date'=>'required|date'

        ]);



        $sample = Sample::create([

            'company_id'=>$request->company_id,

            'product_id'=>$request->product_id,

            'sample_number'=>$request->sample_number,

            'batch_number'=>$request->batch_number,

            'sample_date'=>$request->sample_date,

            'quantity'=>$request->quantity,

            'remarks'=>$request->remarks,

            'status'=>'Pending'

        ]);

        ActivityLogService::log(
    'Create',
    'Sample',
    'Sample "'.$sample->sample_number.'" Created'
);

AuditTrailService::store(
    'Sample',
    $sample->id,
    'Create',
    null,
    $sample->toArray()
);



        return redirect()
        ->route('samples.index')
        ->with('success','Sample Added Successfully');

    }

    public function getProducts($company_id)
{
    $products = Product::where('company_id',$company_id)
                ->get();

    return response()->json($products);
}

public function show(Sample $sample)
{

    $sample->load(['company','product']);

    return view('samples.show',compact('sample'));

}



public function edit(Sample $sample)
{

    $companies = Company::all();


    $products = Product::where(
        'company_id',
        $sample->company_id
    )->get();



    return view('samples.edit',
    compact(
        'sample',
        'companies',
        'products'
    ));

}



public function update(Request $request, Sample $sample)
{
$oldData = $sample->toArray();
    $request->validate([

        'company_id'=>'required',

        'product_id'=>'required',

        'sample_number'=>'required',

        'batch_number'=>'required',

        'sample_date'=>'required|date'

    ]);



    $sample->update([


        'company_id'=>$request->company_id,

        'product_id'=>$request->product_id,

        'sample_number'=>$request->sample_number,

        'batch_number'=>$request->batch_number,

        'sample_date'=>$request->sample_date,

        'quantity'=>$request->quantity,

        'remarks'=>$request->remarks,

        'status'=>$request->status


    ]);
    ActivityLogService::log(
    'Update',
    'Sample',
    'Sample "'.$sample->sample_number.'" Updated'
);

AuditTrailService::store(
    'Sample',
    $sample->id,
    'Update',
    $oldData,
    $sample->fresh()->toArray()
);



    return redirect()
    ->route('samples.index')
    ->with('success','Sample Updated Successfully');


}



public function destroy(Sample $sample)
{
    $oldData = $sample->toArray();

    $sampleNumber = $sample->sample_number;

    $sample->delete();

    ActivityLogService::log(
        'Delete',
        'Sample',
        'Sample "'.$sampleNumber.'" Deleted'
    );

    AuditTrailService::store(
        'Sample',
        $sample->id,
        'Delete',
        $oldData,
        null
    );

    return redirect()
        ->route('samples.index')
        ->with('success','Sample Deleted Successfully');
}

}