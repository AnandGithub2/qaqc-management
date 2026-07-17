@extends('layouts.app')


@section('content')


<h2>
Add Test Parameter
</h2>



<div class="card shadow">

<div class="card-body">


<form method="POST"
action="{{route('test-parameters.store')}}">


@csrf



<div class="mb-3">

<label>
Test Code
</label>


<input
name="test_code"
class="form-control">

</div>




<div class="mb-3">

<label>
Test Name
</label>


<input
name="test_name"
class="form-control">

</div>




<div class="mb-3">

<label>
Unit
</label>


<input
name="unit"
class="form-control">

</div>




<div class="mb-3">

<label>
Specification
</label>


<textarea
name="specification"
class="form-control"></textarea>


</div>




<button class="btn btn-primary">

Save Test

</button>


</form>


</div>

</div>


@endsection