@extends('layouts.app')


@section('content')


<h2>
Batch Traceability
</h2>


<div class="card shadow">

<div class="card-body">


<form method="POST"
action="{{route('batch.search')}}">

@csrf


<label>
Enter Batch Number
</label>


<input 
type="text"
name="batch_number"
class="form-control"
placeholder="Example: BATCH001"
>


<br>


<button class="btn btn-primary">

Search Batch

</button>


</form>


</div>

</div>


@endsection