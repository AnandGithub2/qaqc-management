@extends('layouts.app')

@section('content')

<div class="container-fluid">


<div class="card shadow border-0 mb-4">

<div class="card-body">

<h2 class="fw-bold">
<i class="bi bi-search text-warning"></i>

Global Search

</h2>

<p class="text-muted">
Search Company, Product, Batch, Sample & COA
</p>


<form method="GET"
action="{{ route('global.search') }}">


<div class="input-group input-group-lg">

<input 
type="text"
name="search"
class="form-control"
placeholder="Enter Batch Number / Company / Product..."
value="{{ $keyword ?? '' }}"
>


<button class="btn btn-warning">

<i class="bi bi-search"></i>

Search

</button>


</div>


</form>


</div>

</div>





@if($keyword)



<div class="row">



{{-- COMPANY --}}


<div class="col-lg-6 mb-4">


<div class="card shadow border-0">


<div class="card-header bg-primary text-white">

<h5>
Companies
</h5>

</div>


<div class="card-body">


@if($companies->count())


<table class="table">

<tr>
<th>Name</th>
<th>Email</th>
</tr>


@foreach($companies as $company)

<tr>

<td>
{{ $company->company_name }}
</td>

<td>
{{ $company->email ?? '-' }}
</td>

</tr>

@endforeach


</table>


@else

<p class="text-muted">
No Company Found
</p>

@endif


</div>


</div>


</div>





{{-- PRODUCTS --}}


<div class="col-lg-6 mb-4">


<div class="card shadow border-0">


<div class="card-header bg-success text-white">

<h5>
Products
</h5>

</div>


<div class="card-body">


@if($products->count())


<table class="table">


<tr>

<th>
Product
</th>

</tr>



@foreach($products as $product)

<tr>

<td>

{{ $product->product_name }}

</td>


</tr>


@endforeach


</table>


@else

<p>
No Product Found
</p>

@endif



</div>


</div>


</div>





{{-- SAMPLE --}}


<div class="col-lg-12 mb-4">


<div class="card shadow border-0">


<div class="card-header bg-warning">

<h5>
Samples / Batch Traceability
</h5>


</div>



<div class="card-body">


@if($samples->count())


<table class="table table-bordered">


<thead>

<tr>

<th>
Sample No
</th>

<th>
Batch
</th>

<th>
Company
</th>

<th>
Product
</th>

<th>
Status
</th>

</tr>

</thead>


<tbody>



@foreach($samples as $sample)


<tr>


<td>

{{ $sample->sample_number }}

</td>


<td>

{{ $sample->batch_number }}

</td>


<td>

{{ $sample->company->company_name }}

</td>


<td>

{{ $sample->product->product_name }}

</td>



<td>


@if($sample->qa_status=="Approved")

<span class="badge bg-success">
Approved
</span>


@elseif($sample->qa_status=="Rejected")

<span class="badge bg-danger">
Rejected
</span>


@else

<span class="badge bg-warning text-dark">
Pending
</span>


@endif



</td>


</tr>


@endforeach



</tbody>


</table>



@else


<p>
No Sample Found
</p>


@endif



</div>


</div>


</div>





{{-- COA --}}


<div class="col-lg-12 mb-4">


<div class="card shadow border-0">


<div class="card-header bg-danger text-white">

<h5>
COA Records
</h5>


</div>


<div class="card-body">


@if($coas->count())


<table class="table">


<tr>

<th>
COA Number
</th>

<th>
Sample
</th>


</tr>



@foreach($coas as $coa)


<tr>


<td>

{{ $coa->coa_number }}

</td>


<td>

{{ $coa->sample->sample_number ?? '-' }}

</td>


</tr>


@endforeach



</table>


@else


<p>
No COA Found
</p>


@endif


</div>


</div>


</div>




</div>



@endif



</div>


@endsection