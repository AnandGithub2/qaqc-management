@extends('layouts.app')


@section('content')


<h2>
Product Details
</h2>



<div class="card shadow">

<div class="card-body">


<h4>
{{$product->product_name}}
</h4>


<p>
Company:

{{$product->company->company_name}}

</p>



<p>
Code:

{{$product->product_code}}

</p>



<p>
Category:

{{$product->category}}

</p>



<p>
Description:

{{$product->description}}

</p>



</div>

</div>



@endsection