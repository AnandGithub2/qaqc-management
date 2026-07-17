@extends('layouts.app')


@section('content')


<h2>
Edit Company
</h2>


<div class="card shadow">

<div class="card-body">


<form method="POST"
action="{{route('companies.update',$company->id)}}">


@csrf

@method('PUT')


<div class="mb-3">

<label>
Company Code
</label>

<input
name="company_code"
class="form-control"
value="{{$company->company_code}}">

</div>



<div class="mb-3">

<label>
Company Name
</label>

<input
name="company_name"
class="form-control"
value="{{$company->company_name}}">

</div>



<div class="mb-3">

<label>
Email
</label>

<input
name="email"
class="form-control"
value="{{$company->email}}">

</div>



<div class="mb-3">

<label>
Phone
</label>

<input
name="phone"
class="form-control"
value="{{$company->phone}}">

</div>



<button class="btn btn-primary">

Update Company

</button>


</form>


</div>

</div>


@endsection