@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2>Samples</h2>

    <a href="{{ route('samples.create') }}"
       class="btn btn-primary">

        + Add Sample

    </a>

</div>

<div class="card shadow">

<div class="card-body">

<form method="GET"
      action="{{ route('samples.index') }}"
      class="row mb-3">

<div class="col-md-5">

<input
type="text"
name="search"
value="{{ request('search') }}"
class="form-control"
placeholder="Search Sample, Batch, Company or Product">

</div>

<div class="col-md-3">

<button class="btn btn-primary">

Search

</button>

<a href="{{ route('samples.index') }}"
class="btn btn-secondary">

Reset

</a>

</div>

<div class="col-md-4 text-end">

<b>Total Records :</b>

{{ $samples->total() }}

</div>

</form>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>Sample No</th>

<th>Company</th>

<th>Product</th>

<th>Batch</th>

<th>QA Status</th>

<th width="300">Action</th>

</tr>

</thead>

<tbody>

@forelse($samples as $sample)

<tr>

<td>{{ $sample->sample_number }}</td>

<td>{{ $sample->company->company_name }}</td>

<td>{{ $sample->product->product_name }}</td>

<td>{{ $sample->batch_number }}</td>

<td>

@if($sample->qa_status=='Approved')

<span class="badge bg-success">

Approved

</span>

@elseif($sample->qa_status=='Rejected')

<span class="badge bg-danger">

Rejected

</span>

@else

<span class="badge bg-warning">

Pending

</span>

@endif

</td>

<td>

<a href="{{ route('samples.show',$sample->id) }}"
class="btn btn-info btn-sm">

View

</a>

<a href="{{ route('samples.edit',$sample->id) }}"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="{{ route('sample-tests.create',$sample->id) }}"
class="btn btn-success btn-sm">

Assign Test

</a>

@if($sample->qa_status=='Approved')

<a href="{{ route('coa.generate',$sample->id) }}"
class="btn btn-primary btn-sm">

COA

</a>

@endif

<form
action="{{ route('samples.destroy',$sample->id) }}"
method="POST"
class="d-inline">

@csrf

@method('DELETE')

<button
onclick="return confirm('Delete Sample?')"
class="btn btn-danger btn-sm">

Delete

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="6" class="text-center">

No Samples Found

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="mt-3">

{{ $samples->links() }}

</div>

</div>

</div>

@endsection