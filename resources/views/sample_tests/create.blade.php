@extends('layouts.app')


@section('content')


<h2>
Assign Test
</h2>



<div class="card shadow">

<div class="card-body">


<h5>
Sample:

{{$sample->sample_number}}

</h5>


<form method="POST"
action="{{route('sample-tests.store')}}">


@csrf


<input type="hidden"
name="sample_id"
value="{{$sample->id}}">



<h5>
Select Tests
</h5>



@foreach($tests as $test)


<div class="form-check">


<input
class="form-check-input"
type="checkbox"
name="tests[]"
value="{{$test->id}}">


<label class="form-check-label">

{{$test->test_name}}

</label>


</div>



@endforeach



<br>


<button class="btn btn-primary">

Assign Tests

</button>



</form>


</div>

</div>


@endsection