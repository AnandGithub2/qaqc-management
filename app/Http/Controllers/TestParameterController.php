<?php

namespace App\Http\Controllers;

use App\Models\TestParameter;
use Illuminate\Http\Request;

class TestParameterController extends Controller
{


    public function index()
    {

        $tests = TestParameter::latest()->get();

        return view('test_parameters.index',
        compact('tests'));

    }



    public function create()
    {

        return view('test_parameters.create');

    }



    public function store(Request $request)
    {

        $request->validate([

            'test_code'=>'required|unique:test_parameters',

            'test_name'=>'required'

        ]);



        TestParameter::create([

            'test_code'=>$request->test_code,

            'test_name'=>$request->test_name,

            'unit'=>$request->unit,

            'specification'=>$request->specification,

            'status'=>$request->status ?? 1

        ]);



        return redirect()
        ->route('test-parameters.index')
        ->with('success','Test Added Successfully');

    }




    public function edit(TestParameter $test_parameter)
    {

        return view('test_parameters.edit',
        compact('test_parameter'));

    }





    public function update(Request $request,
    TestParameter $test_parameter)
    {


        $request->validate([

            'test_code'=>'required',

            'test_name'=>'required'

        ]);



        $test_parameter->update([


            'test_code'=>$request->test_code,

            'test_name'=>$request->test_name,

            'unit'=>$request->unit,

            'specification'=>$request->specification,

            'status'=>$request->status ?? 1


        ]);



        return redirect()
        ->route('test-parameters.index')
        ->with('success','Test Updated Successfully');


    }





    public function destroy(TestParameter $test_parameter)
    {

        $test_parameter->delete();


        return redirect()
        ->route('test-parameters.index')
        ->with('success','Test Deleted Successfully');

    }


}