@extends('layouts.app')


@section('content')


<h2>
Add Sample
</h2>


<div class="card shadow">

<div class="card-body">


<form method="POST"
action="{{route('samples.store')}}">


@csrf


<div class="mb-3">

<label>
Company
</label>


<select 
name="company_id"
id="company_id"
class="form-control"
>

<option value="">
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
Product
</label>


<select
name="product_id"
id="product_id"
class="form-control"
>

<option value="">
Select Product
</option>

</select>

</div>




<div class="mb-3">

<label>
Sample Number
</label>


<input
name="sample_number"
class="form-control">


</div>




<div class="mb-3">

<label>
Batch Number
</label>


<input
name="batch_number"
class="form-control">


</div>




<div class="mb-3">

<label>
Sample Date
</label>


<input
type="date"
name="sample_date"
max="{{date('Y-m-d')}}"
class="form-control">


</div>




<div class="mb-3">

<label>
Quantity
</label>


<input
name="quantity"
class="form-control">


</div>




<div class="mb-3">

<label>
Remarks
</label>


<textarea
name="remarks"
class="form-control"></textarea>


</div>




<button class="btn btn-primary">

Save Sample

</button>



</form>


</div>

</div>


@endsection


<script>

document.addEventListener("DOMContentLoaded", function(){


let company = document.getElementById('company_id');

let product = document.getElementById('product_id');


company.addEventListener('change', function(){


let id = this.value;


product.innerHTML =
'<option>Loading...</option>';



fetch("/company-products/" + id)


.then(res => res.json())


.then(data => {


product.innerHTML =
'<option value="">Select Product</option>';



data.forEach(function(item){


product.innerHTML +=
`
<option value="${item.id}">
${item.product_name}
</option>
`;


});


});


});


});

</script>