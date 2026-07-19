<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\Product;
use App\Models\Sample;
use App\Models\COA;


class GlobalSearchController extends Controller
{


public function index(Request $request)
{

    $keyword = $request->search;


    $companies = collect();
    $products = collect();
    $samples = collect();
    $coas = collect();



    if($keyword)
    {


        $companies = Company::where(
            'company_name',
            'LIKE',
            "%$keyword%"
        )
        ->get();



        $products = Product::where(
            'product_name',
            'LIKE',
            "%$keyword%"
        )
        ->get();



        $samples = Sample::with([
            'company',
            'product'
        ])
        ->where('sample_number','LIKE',"%$keyword%")
        ->orWhere('batch_number','LIKE',"%$keyword%")
        ->get();



        $coas = COA::with('sample')
        ->where(
            'coa_number',
            'LIKE',
            "%$keyword%"
        )
        ->get();


    }



    return view(
        'search.index',
        compact(
            'companies',
            'products',
            'samples',
            'coas',
            'keyword'
        )
    );


}


}