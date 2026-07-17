@extends('layouts.app')


@section('content')


<h2>
Enter Test Result
</h2>



<div class="card shadow">

<div class="card-body">


<h5>
Sample:
{{$sampleTest->sample->sample_number}}
</h5>


<h5>
Test:
{{$sampleTest->testParameter->test_name}}
</h5>



<form method="POST"
action="{{route('sample-tests.update',$sampleTest->id)}}">


@csrf

@method('PUT')



<div class="mb-3">

<label>
Result
</label>


<input
name="result"
class="form-control"
value="{{$sampleTest->result}}">


</div>




<div class="mb-3">

<label>
Status
</label>


<select
name="test_status"
class="form-control">


<option value="Completed">
Completed
</option>


<option value="Rejected">
Rejected
</option>


</select>


</div>




<div class="mb-3">

<label>
Remarks
</label>


<textarea
name="remarks"
class="form-control">{{$sampleTest->remarks}}</textarea>


</div>



<button class="btn btn-primary">

Save Result

</button>



</form>


</div>

</div>


@endsection