<?php

namespace App\Http\Controllers;
use App\Models\AuditTrail;
use App\Models\Sample;
use Illuminate\Http\Request;


class BatchTraceabilityController extends Controller
{


    public function index()
    {

        return view('batch_traceability.index');

    }



public function search(Request $request)
{
    $request->validate([
        'batch_number' => 'required'
    ]);

    $sample = Sample::with([
        'company',
        'product',
        'sampleTests.testParameter',
        'histories.user',
        'approvedBy',
        'coa'
    ])
    ->where('batch_number', $request->batch_number)
    ->first();

    if (!$sample) {
        return back()->with('error', 'Batch Not Found');
    }

    $audits = AuditTrail::where('record_id', $sample->id)
        ->where('module', 'Sample')
        ->latest()
        ->get();

    return view(
        'batch_traceability.show',
        compact(
            'sample',
            'audits'
        )
    );
}

}