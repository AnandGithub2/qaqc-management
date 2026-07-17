@extends('layouts.app')


@section('content')


<h2>
Add Product
</h2>



<div class="card shadow">

<div class="card-body">


<form method="POST"
action="{{route('products.store')}}">


@csrf



<div class="mb-3">

<label>
Select Company
</label>


<select name="company_id"
class="form-control">


<option>
Select Company
</option>


@foreach($companies as $company)


<option value="{{$company->id}}">

{{$company->company_name}}

</option>


@endforeach


</select>


</div>



<div class="mb-3">

<label>
Product Code
</label>


<input
type="text"
name="product_code"
class="form-control">

</div>



<div class="mb-3">

<label>
Product Name
</label>


<input
type="text"
name="product_name"
class="form-control">

</div>



<div class="mb-3">

<label>
Category
</label>


<input
type="text"
name="category"
class="form-control">

</div>



<div class="mb-3">

<label>
Description
</label>


<textarea
name="description"
class="form-control"></textarea>


</div>



<button class="btn btn-primary">

Save Product

</button>



</form>


</div>

</div>


@endsection