@extends('layouts.app')


@section('content')


<h2>
Edit Sample
</h2>


<div class="card shadow">

<div class="card-body">


<form method="POST"
action="{{route('samples.update',$sample->id)}}">


@csrf

@method('PUT')



<div class="mb-3">

<label>
Sample Number
</label>


<input
name="sample_number"
class="form-control"
value="{{$sample->sample_number}}">


</div>



<div class="mb-3">

<label>
Batch Number
</label>


<input
name="batch_number"
class="form-control"
value="{{$sample->batch_number}}">


</div>



<div class="mb-3">

<label>
Sample Date
</label>


<input
type="date"
name="sample_date"
class="form-control"
value="{{$sample->sample_date}}">


</div>



<div class="mb-3">

<label>
Quantity
</label>


<input
name="quantity"
class="form-control"
value="{{$sample->quantity}}">


</div>



<div class="mb-3">

<label>
Remarks
</label>


<textarea
name="remarks"
class="form-control">{{$sample->remarks}}</textarea>


</div>



<button class="btn btn-primary">

Update Sample

</button>


</form>


</div>

</div>


@endsection