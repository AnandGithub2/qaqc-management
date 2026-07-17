@extends('layouts.app')


@section('content')


<div class="d-flex justify-content-between mb-3">


<h2>
Test Parameters
</h2>


<a href="{{route('test-parameters.create')}}"
class="btn btn-primary">

+ Add Test

</a>


</div>




<div class="card shadow">

<div class="card-body">


<table class="table">


<tr>

<th>
Code
</th>

<th>
Test Name
</th>

<th>
Unit
</th>

<th>
Specification
</th>

<th>
Action
</th>

</tr>




@foreach($tests as $test)



<tr>


<td>
{{$test->test_code}}
</td>


<td>
{{$test->test_name}}
</td>


<td>
{{$test->unit}}
</td>


<td>
{{$test->specification}}
</td>



<td>


<a href="{{route('test-parameters.edit',$test->id)}}"
class="btn btn-warning btn-sm">

Edit

</a>




<form
action="{{route('test-parameters.destroy',$test->id)}}"
method="POST"
style="display:inline">


@csrf

@method('DELETE')


<button
class="btn btn-danger btn-sm"
onclick="return confirm('Delete Test?')">

Delete

</button>


</form>


</td>


</tr>



@endforeach



</table>


</div>

</div>


@endsection