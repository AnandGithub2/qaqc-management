@extends('layouts.app')


@section('content')


<h2>
Test Results
</h2>



<div class="card shadow">

<div class="card-body">


<table class="table">


<tr>

<th>
Sample
</th>

<th>
Test
</th>

<th>
Result
</th>

<th>
Status
</th>

<th>
Action
</th>

</tr>



@foreach($sampleTests as $test)



<tr>


<td>
{{$test->sample->sample_number}}
</td>


<td>
{{$test->testParameter->test_name}}
</td>


<td>

{{$test->result ?? 'Pending'}}

</td>


<td>

{{$test->test_status}}

</td>


<td>


<a href="{{route('sample-tests.edit',$test->id)}}"
class="btn btn-warning btn-sm">

Enter Result

</a>


</td>


</tr>


@endforeach



</table>


</div>

</div>


@endsection