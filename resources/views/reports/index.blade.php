@extends('layouts.app')

@section('content')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="fw-bold mb-0">
            Reports Dashboard
        </h2>

        <small class="text-muted">
            Sample Reports & Analytics
        </small>
    </div>

</div>

{{-- SUMMARY CARDS --}}

<div class="row mb-4">

<div class="col-lg-3 col-md-6 mb-3">
<div class="card shadow border-0">
<div class="card-body text-center">
<i class="bi bi-beaker display-5 text-primary"></i>
<h6 class="mt-2">Total Samples</h6>
<h2>{{ $samples->count() }}</h2>
</div>
</div>
</div>

<div class="col-lg-3 col-md-6 mb-3">
<div class="card shadow border-0">
<div class="card-body text-center">
<i class="bi bi-file-earmark-pdf display-5 text-danger"></i>
<h6 class="mt-2">Generated COA</h6>
<h2>{{ $coaCount }}</h2>
</div>
</div>
</div>

<div class="col-lg-3 col-md-6 mb-3">
<div class="card shadow border-0">
<div class="card-body text-center">
<i class="bi bi-check-circle display-5 text-success"></i>
<h6 class="mt-2">Approved</h6>
<h2>{{ $samples->where('qa_status','Approved')->count() }}</h2>
</div>
</div>
</div>

<div class="col-lg-3 col-md-6 mb-3">
<div class="card shadow border-0">
<div class="card-body text-center">
<i class="bi bi-hourglass-split display-5 text-warning"></i>
<h6 class="mt-2">Pending</h6>
<h2>{{ $samples->where('qa_status','Pending')->count() }}</h2>
</div>
</div>
</div>

</div>

{{-- FILTER --}}

<div class="card shadow border-0 mb-4">

<div class="card-header bg-primary text-white">

<h5 class="mb-0">

Search Report

</h5>

</div>

<div class="card-body">

<form action="{{ route('report.sample') }}" method="GET">

<div class="row">

<div class="col-md-3 mb-3">

<label>Company</label>

<select name="company_id" class="form-select">

<option value="">All Companies</option>

@foreach($companies as $company)

<option value="{{ $company->id }}">

{{ $company->company_name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-3 mb-3">

<label>Product</label>

<select name="product_id" class="form-select">

<option value="">All Products</option>

@foreach($products as $product)

<option value="{{ $product->id }}">

{{ $product->product_name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-2 mb-3">

<label>Status</label>

<select name="qa_status" class="form-select">

<option value="">All</option>

<option>Approved</option>

<option>Pending</option>

<option>Rejected</option>

</select>

</div>

<div class="col-md-2 mb-3">

<label>From</label>

<input type="date" name="from_date" class="form-control">

</div>

<div class="col-md-2 mb-3">

<label>To</label>

<input type="date" name="to_date" class="form-control">

</div>

</div>

<div class="mt-2">

<button class="btn btn-primary">

<i class="bi bi-search"></i>

Search

</button>

<button class="btn btn-primary">
Search
</button>

<button
type="submit"
formaction="{{ route('report.pdf') }}"
class="btn btn-danger">

<i class="bi bi-file-earmark-pdf"></i>

Download PDF

</button>

</div>

</form>

</div>

</div>

{{-- TABLE --}}

<div class="card shadow border-0">

<div class="card-header bg-success text-white">

<h5 class="mb-0">

Sample Report

</h5>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover table-bordered align-middle">

<thead class="table-light">

<tr>

<th>#</th>

<th>Sample No</th>

<th>Company</th>

<th>Product</th>

<th>Batch</th>

<th>Date</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@forelse($samples as $sample)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $sample->sample_number }}</td>

<td>{{ $sample->company->company_name }}</td>

<td>{{ $sample->product->product_name }}</td>

<td>{{ $sample->batch_number }}</td>

<td>{{ \Carbon\Carbon::parse($sample->sample_date)->format('d M Y') }}</td>

<td>

@if($sample->qa_status=='Approved')

<span class="badge bg-success">Approved</span>

@elseif($sample->qa_status=='Rejected')

<span class="badge bg-danger">Rejected</span>

@else

<span class="badge bg-warning text-dark">Pending</span>

@endif

</td>

</tr>

@empty

<tr>

<td colspan="7" class="text-center">

No Records Found

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>
<div class="mb-3">

<a href="{{ route('report.pdf') }}"
class="btn btn-danger">

<i class="bi bi-file-earmark-pdf"></i>

Download Report PDF

</a>

</div>
</div>

</div>

@endsection