@extends('layouts.app')


@section('content')


<h2>Add Company</h2>


<div class="card shadow">

<div class="card-body">


<form method="POST" action="{{route('companies.store')}}">

@csrf


<div class="mb-3">

<label>
Company Code
</label>

<input 
type="text"
name="company_code"
class="form-control">

</div>



<div class="mb-3">

<label>
Company Name
</label>

<input 
type="text"
name="company_name"
class="form-control">

</div>



<div class="mb-3">

<label>
Email
</label>

<input 
type="email"
name="email"
class="form-control">

</div>



<div class="mb-3">

<label>
Phone
</label>

<input 
type="text"
name="phone"
class="form-control">

</div>



<div class="mb-3">

<label>
GST Number
</label>

<input 
type="text"
name="gst_number"
class="form-control">

</div>

<div class="mb-3">

<label>
Country
</label>

<input 
type="text"
name="country"
value="India"
class="form-control">

</div>

<div class="mb-3">

<label>
Address
</label>

<textarea
name="address"
class="form-control"></textarea>

</div>



<button class="btn btn-primary">

Save Company

</button>


</form>


</div>

</div>


@endsection