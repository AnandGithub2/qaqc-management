<?php

namespace App\Http\Controllers;
use App\Services\ActivityLogService;
use App\Services\AuditTrailService;
use App\Models\Sample;
use App\Models\TestParameter;
use App\Models\SampleTest;
use Illuminate\Http\Request;


class SampleTestController extends Controller
{
public static function middleware(): array
{
    return [
        'permission:assign tests',
        'permission:enter test results',
    ];
}

    public function create($sample_id)
    {

        $sample = Sample::findOrFail($sample_id);


        $tests = TestParameter::where('status',1)
                ->get();


        return view(
            'sample_tests.create',
            compact('sample','tests')
        );

    }



    public function store(Request $request)
    {


        $request->validate([

            'sample_id'=>'required',

            'tests'=>'required|array'

        ]);



        foreach($request->tests as $test_id)
{

    $sampleTest = SampleTest::create([

        'sample_id'=>$request->sample_id,

        'test_parameter_id'=>$test_id,

        'result'=>null,

        'test_status'=>'Pending',

        'remarks'=>null,

    ]);

    ActivityLogService::log(
        'Create',
        'Sample Test',
        'Test Assigned'
    );

    AuditTrailService::store(
        'Sample Test',
        $sampleTest->id,
        'Create',
        null,
        $sampleTest->toArray()
    );

}


        return redirect()
        ->route('samples.index')
        ->with(
        'success',
        'Tests Assigned Successfully'
        );


    }

public function index()
{

    $sampleTests = SampleTest::with([
        'sample',
        'testParameter'
    ])
    ->latest()
    ->get();


    return view(
        'sample_tests.index',
        compact('sampleTests')
    );

}

public function edit(SampleTest $sampleTest)
{

    $sampleTest->load([
        'sample',
        'testParameter'
    ]);


    return view(
        'sample_tests.edit',
        compact('sampleTest')
    );

}

public function update(Request $request,
SampleTest $sampleTest)
{
$oldData = $sampleTest->toArray();

    $request->validate([

        'result'=>'required',

        'test_status'=>'required'

    ]);



    $sampleTest->update([


        'result'=>$request->result,

        'remarks'=>$request->remarks,

        'test_status'=>$request->test_status


    ]);

   ActivityLogService::log(
    'Update',
    'Sample Test',
    'Result Updated'
);

AuditTrailService::store(
    'Sample Test',
    $sampleTest->id,
    'Update',
    $oldData,
    $sampleTest->fresh()->toArray()
);





    return redirect()
    ->route('sample-tests.index')
    ->with(
    'success',
    'Result Updated Successfully'
    );


}
public function destroy(SampleTest $sampleTest)
{

    $oldData = $sampleTest->toArray();

    $sampleTest->delete();

    ActivityLogService::log(
        'Delete',
        'Sample Test',
        'Sample Test Deleted'
    );

    AuditTrailService::store(
        'Sample Test',
        $sampleTest->id,
        'Delete',
        $oldData,
        null
    );

    return redirect()
        ->route('sample-tests.index')
        ->with('success','Deleted Successfully');

}
}