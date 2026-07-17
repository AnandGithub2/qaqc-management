@extends('layouts.app')


@section('content')


<h2>
Edit Test
</h2>



<div class="card shadow">

<div class="card-body">


<form method="POST"
action="{{route('test-parameters.update',$test_parameter->id)}}">


@csrf

@method('PUT')



<div class="mb-3">

<label>
Test Code
</label>


<input
name="test_code"
class="form-control"
value="{{$test_parameter->test_code}}">


</div>




<div class="mb-3">

<label>
Test Name
</label>


<input
name="test_name"
class="form-control"
value="{{$test_parameter->test_name}}">


</div>




<div class="mb-3">

<label>
Unit
</label>


<input
name="unit"
class="form-control"
value="{{$test_parameter->unit}}">


</div>




<div class="mb-3">

<label>
Specification
</label>


<textarea
name="specification"
class="form-control">{{$test_parameter->specification}}</textarea>


</div>



<button class="btn btn-primary">

Update

</button>


</form>


</div>

</div>


@endsection