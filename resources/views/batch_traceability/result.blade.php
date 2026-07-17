@extends('layouts.app')

@section('content')

<div class="container-fluid">


<h2>
Batch Traceability
</h2>



<div class="card shadow mb-3">

<div class="card-header">

Batch Information

</div>


<div class="card-body">


<p>
<b>Batch Number:</b>
{{ $sample->batch_number }}
</p>


<p>
<b>Sample Number:</b>
{{ $sample->sample_number }}
</p>


<p>
<b>Company:</b>
{{ $sample->company->company_name }}
</p>


<p>
<b>Product:</b>
{{ $sample->product->product_name }}
</p>


<p>
<b>QA Status:</b>


@if($sample->qa_status=="Approved")

<span class="badge bg-success">
Approved
</span>


@elseif($sample->qa_status=="Rejected")

<span class="badge bg-danger">
Rejected
</span>


@else

<span class="badge bg-warning">
Pending
</span>


@endif


</p>


</div>

</div>





<div class="card shadow mb-3">

<div class="card-header">

Test Results

</div>


<div class="card-body">


<table class="table table-bordered">


<tr>

<th>
Test
</th>

<th>
Result
</th>

<th>
Status
</th>

</tr>


@foreach($sample->sampleTests as $test)


<tr>

<td>

{{ $test->testParameter->test_name }}

</td>


<td>

{{ $test->result }}

</td>


<td>

{{ $test->test_status }}

</td>


</tr>


@endforeach


</table>


</div>

</div>






<div class="card shadow mb-3">


<div class="card-header">

Approval History

</div>


<div class="card-body">


<table class="table">


<tr>

<th>
User
</th>

<th>
Action
</th>

<th>
Remarks
</th>

<th>
Date
</th>

</tr>



@foreach($sample->histories as $history)


<tr>

<td>

{{ $history->user->name }}

</td>


<td>

{{ $history->action }}

</td>


<td>

{{ $history->remarks }}

</td>


<td>

{{ $history->created_at }}

</td>


</tr>


@endforeach


</table>


</div>


</div>





<div class="card shadow">


<div class="card-header">

COA Details

</div>


<div class="card-body">


@if($sample->coa)


<p>

<b>COA Number:</b>

{{ $sample->coa->coa_number }}

</p>


<a href="{{ route('coa.generate',$sample->id) }}"
class="btn btn-primary">

Download COA

</a>


@else


<span class="text-muted">

COA Not Generated

</span>


@endif


</div>


</div>



</div>

@endsection