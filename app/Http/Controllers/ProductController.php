<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\AuditTrailService;

class ProductController extends Controller
{

  public function index(Request $request)
{
    $search = $request->search;

    $products = Product::with('company')

        ->when($search, function ($query) use ($search) {

            $query->where('product_name', 'like', "%{$search}%")
                  ->orWhere('product_code', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");

        })

        ->latest()

        ->paginate(10)

        ->withQueryString();

    return view(
        'products.index',
        compact('products', 'search')
    );
}


    public function create()
    {
        $companies = Company::all();

        return view('products.create', compact('companies'));
    }



    public function store(Request $request)
    {

        $request->validate([

            'company_id' => 'required',

            'product_code' => 'required|unique:products',

            'product_name' => 'required',

        ]);



   $product = Product::create([

    'company_id' => $request->company_id,

    'product_code' => $request->product_code,

    'product_name' => $request->product_name,

    'description' => $request->description,

    'category' => $request->category,

    'status' => $request->status ?? 1,

]);

AuditTrailService::store(
    'Product',
    $product->id,
    'Create',
    null,
    $product->toArray()
);
        



        return redirect()
        ->route('products.index')
        ->with('success','Product Added Successfully');

    }

    public function show(Product $product)
{
    $product->load('company');

    return view('products.show', compact('product'));
}



public function edit(Product $product)
{
    $companies = Company::all();

    return view('products.edit', compact('product','companies'));
}



public function update(Request $request, Product $product)
{

    $request->validate([

        'company_id'=>'required',

        'product_code'=>'required',

        'product_name'=>'required',

    ]);


$oldData = $product->toArray();
    $product->update([

        'company_id'=>$request->company_id,

        'product_code'=>$request->product_code,

        'product_name'=>$request->product_name,

        'description'=>$request->description,

        'category'=>$request->category,

        'status'=>$request->status ?? 1,

    ]);

    AuditTrailService::store(
    'Product',
    $product->id,
    'Update',
    $oldData,
    $product->fresh()->toArray()
);



    return redirect()
    ->route('products.index')
    ->with('success','Product Updated Successfully');

}



public function destroy(Product $product)
{
    $oldData = $product->toArray();

    AuditTrailService::store(
        'Product',
        $product->id,
        'Delete',
        $oldData,
        null
    );

    $product->delete();

    return redirect()
        ->route('products.index')
        ->with('success', 'Product Deleted Successfully');
}

}