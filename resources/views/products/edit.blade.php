@extends('layouts.app')


@section('content')


<h2>
Edit Product
</h2>


<div class="card shadow">

<div class="card-body">


<form method="POST"
action="{{route('products.update',$product->id)}}">


@csrf

@method('PUT')



<div class="mb-3">

<label>
Company
</label>


<select name="company_id"
class="form-control">


@foreach($companies as $company)

<option 
value="{{$company->id}}"
@if($company->id==$product->company_id)
selected
@endif
>

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
name="product_code"
class="form-control"
value="{{$product->product_code}}">


</div>



<div class="mb-3">

<label>
Product Name
</label>


<input
name="product_name"
class="form-control"
value="{{$product->product_name}}">


</div>



<div class="mb-3">

<label>
Category
</label>


<input
name="category"
class="form-control"
value="{{$product->category}}">


</div>



<div class="mb-3">

<label>
Description
</label>


<textarea
name="description"
class="form-control">

{{$product->description}}

</textarea>


</div>



<button class="btn btn-primary">

Update Product

</button>


</form>


</div>

</div>


@endsection