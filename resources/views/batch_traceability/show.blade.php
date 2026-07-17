@extends('layouts.app')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-0">
            Batch Traceability
        </h2>
        <small class="text-muted">
            Complete Batch Life Cycle
        </small>
    </div>

    <a href="{{ route('batch.index') }}" class="btn btn-secondary">
        ← Back
    </a>

</div>

{{-- SUMMARY CARDS --}}

<div class="row mb-4">

<div class="col-md-3 mb-3">

<div class="card shadow border-0">

<div class="card-body text-center">

<h6 class="text-muted">
Batch Number
</h6>

<h5 class="fw-bold">
{{ $sample->batch_number }}
</h5>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow border-0">

<div class="card-body text-center">

<h6 class="text-muted">
Sample
</h6>

<h5 class="fw-bold">
{{ $sample->sample_number }}
</h5>

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow border-0">

<div class="card-body text-center">

<h6 class="text-muted">
QA Status
</h6>

@if($sample->qa_status=="Approved")

<span class="badge bg-success fs-6">
Approved
</span>

@elseif($sample->qa_status=="Rejected")

<span class="badge bg-danger fs-6">
Rejected
</span>

@else

<span class="badge bg-warning text-dark fs-6">
Pending
</span>

@endif

</div>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow border-0">

<div class="card-body text-center">

<h6 class="text-muted">
COA
</h6>

@if($sample->coa)

<span class="badge bg-success fs-6">
Generated
</span>

@else

<span class="badge bg-danger fs-6">
Not Generated
</span>

@endif

</div>

</div>

</div>

</div>

{{-- BATCH INFORMATION --}}

<div class="card shadow mb-4">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">
Batch Information
</h5>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="25%">Company</th>

<td>{{ $sample->company->company_name }}</td>

</tr>

<tr>

<th>Product</th>

<td>{{ $sample->product->product_name }}</td>

</tr>

<tr>

<th>Sample Date</th>

<td>{{ \Carbon\Carbon::parse($sample->sample_date)->format('d M Y') }}</td>

</tr>

<tr>

<th>Approved By</th>

<td>{{ optional($sample->approvedBy)->name ?? '-' }}</td>

</tr>

<tr>

<th>Approval Date</th>

<td>

{{ $sample->approval_date ? \Carbon\Carbon::parse($sample->approval_date)->format('d M Y h:i A') : '-' }}

</td>

</tr>

<tr>

<th>Remarks</th>

<td>{{ $sample->approval_remarks ?? '-' }}</td>

</tr>

</table>

</div>

</div>

{{-- TEST RESULTS --}}

<div class="card shadow mb-4">

<div class="card-header bg-success text-white">

<h5 class="mb-0">
Laboratory Test Results
</h5>

</div>

<div class="card-body p-0">

<table class="table table-bordered mb-0">

<thead class="table-light">

<tr>

<th>#</th>

<th>Code</th>

<th>Parameter</th>

<th>Specification</th>

<th>Result</th>

<th>Unit</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($sample->sampleTests as $test)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $test->testParameter->test_code }}</td>

<td>{{ $test->testParameter->test_name }}</td>

<td>{{ $test->testParameter->specification }}</td>

<td>{{ $test->result }}</td>

<td>{{ $test->testParameter->unit }}</td>

<td>

@if(strtoupper($test->test_status)=='PASS')

<span class="badge bg-success">
PASS
</span>

@elseif(strtoupper($test->test_status)=='FAIL')

<span class="badge bg-danger">
FAIL
</span>

@else

<span class="badge bg-warning text-dark">
{{ $test->test_status }}
</span>

@endif

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

{{-- COA --}}

<div class="card shadow mb-4">

<div class="card-header bg-info text-white">

<h5 class="mb-0">
Certificate Of Analysis
</h5>

</div>

<div class="card-body">

@if($sample->coa)

<table class="table table-bordered">

<tr>

<th width="25%">
COA Number
</th>

<td>
{{ $sample->coa->coa_number }}
</td>

</tr>

<tr>

<th>
Issue Date
</th>

<td>

{{ \Carbon\Carbon::parse($sample->coa->issue_date)->format('d M Y') }}

</td>

</tr>

</table>

<div class="d-flex gap-2">

<a href="{{ route('coa.generate',$sample->id) }}"
class="btn btn-primary">

<i class="bi bi-file-earmark-pdf"></i>

Download PDF

</a>

<button
onclick="window.print()"
class="btn btn-success">

<i class="bi bi-printer"></i>

Print

</button>

</div>

@else

<div class="alert alert-warning mb-0">

COA Not Generated Yet

</div>

@endif

</div>

</div>

{{-- SAMPLE HISTORY --}}

<div class="card shadow mb-4">

<div class="card-header bg-dark text-white">

<h5 class="mb-0">

Sample History

</h5>

</div>

<div class="card-body p-0">

<table class="table table-striped mb-0">

<thead>

<tr>
<th>#</th>
<th>User</th>

<th>Action</th>

<th>Remarks</th>

<th>Date</th>

</tr>

</thead>

<tbody>

@forelse($sample->histories as $history)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ optional($history->user)->name }}</td>

<td>{{ $history->action }}</td>

<td>{{ $history->remarks }}</td>

<td>{{ $history->created_at->format('d M Y h:i A') }}</td>

</tr>

@empty

<tr>

<td colspan="4" class="text-center">

No History

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

{{-- AUDIT TRAIL --}}

<div class="card shadow">

<div class="card-header bg-danger text-white">

<h5 class="mb-0">

Audit Trail

</h5>

</div>

<div class="card-body p-0">

<table class="table table-bordered mb-0">

<thead>

<tr>

<th>#</th>
<th>User</th>

<th>Module</th>

<th>Action</th>

<th>Date</th>

</tr>

</thead>

<tbody>

@forelse($audits as $audit)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ optional($audit->user)->name }}</td>

<td>{{ $audit->module }}</td>

<td>{{ $audit->action }}</td>

<td>{{ $audit->created_at->format('d M Y h:i A') }}</td>

</tr>

@empty

<tr>

<td colspan="4" class="text-center">

No Audit Records Found

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

@endsection