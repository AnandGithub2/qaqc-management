<?php

namespace App\Http\Controllers;

use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ActivityLogService;
use App\Models\SampleHistory;
use App\Models\User;
use App\Notifications\SampleApprovedNotification;



class QAApprovalController extends Controller
{
    public static function middleware(): array
{
    return [
        'permission:approve samples'
    ];
}
    public function index()
    {
       $samples = Sample::with([
    'company',
    'product',
    'sampleTests.testParameter',
    'approvedBy',
    'histories.user'
])->latest()->get();

        return view('qa_approval.index', compact('samples'));
    }

    public function approve(Request $request, Sample $sample)
    {
        // Already Approved/Rejected
        if ($sample->qa_status != 'Pending') {
            return back()->with('error', 'This sample has already been finalized.');
        }

        $sample->update([
            'qa_status' => 'Approved',
            'approved_by' => Auth::id(),
            'approval_date' => now(),
            'approval_remarks' => $request->approval_remarks,
        ]);
// Send notification to all Admin users

$admins = User::role('Admin')->get();

foreach ($admins as $admin) {

    $admin->notify(new SampleApprovedNotification($sample));

}
        
        SampleHistory::create([
    'sample_id' => $sample->id,
    'user_id'   => Auth::id(),
    'action'    => 'Approved',
    'remarks'   => $request->approval_remarks,
]);
        ActivityLogService::log(
            'Approve',
            'QA Approval',
            'Approved Sample : '.$sample->sample_number
        );

        return redirect()->route('qa.index')
            ->with('success','Sample Approved Successfully');
    }

    public function reject(Request $request, Sample $sample)
    {
        if ($sample->qa_status != 'Pending') {
            return back()->with('error','This sample has already been finalized.');
        }

        $sample->update([
            'qa_status'=>'Rejected',
            'approved_by'=>Auth::id(),
            'approval_date'=>now(),
            'approval_remarks'=>$request->approval_remarks,
        ]);

        $admins = User::role('Admin')->get();

foreach ($admins as $admin) {

    $admin->notify(new SampleApprovedNotification($sample));

}
        SampleHistory::create([
    'sample_id' => $sample->id,
    'user_id'   => Auth::id(),
    'action'    => 'Rejected',
    'remarks'   => $request->approval_remarks,
]);

        ActivityLogService::log(
            'Reject',
            'QA Approval',
            'Rejected Sample : '.$sample->sample_number
        );

        return redirect()->route('qa.index')
            ->with('success','Sample Rejected Successfully');
    }
}