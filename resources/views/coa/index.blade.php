@extends('layouts.app')


@section('content')

<h2>
COA Management
</h2>


<div class="card shadow">

<div class="card-body">


<table class="table table-bordered">


<tr>

<th>COA Number</th>
<th>Sample</th>
<th>Company</th>
<th>Product</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>

</tr>


@foreach($coas as $coa)


<tr>


<td>
{{ $coa->coa_number }}
</td>


<td>
{{ $coa->sample->sample_number }}
</td>


<td>
{{ $coa->sample->company->company_name }}
</td>


<td>
{{ $coa->sample->product->product_name }}
</td>


<td>
{{ $coa->issue_date }}
</td>


<td>

<span class="badge bg-success">
{{ $coa->status }}
</span>

</td>


<td>


<a href="{{route('coa.generate',$coa->sample_id)}}"
class="btn btn-primary btn-sm">

Download PDF

</a>
<a
href="{{ route('coa.mail',$sample->id) }}"
class="btn btn-success">

Email COA

</a>

</td>


</tr>


@endforeach


</table>


</div>

</div>


@endsection