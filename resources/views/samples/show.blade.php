@extends('layouts.app')


@section('content')


<h2>
Sample Details
</h2>


<div class="card shadow">

<div class="card-body">


<h4>
{{$sample->sample_number}}
</h4>


<p>
Company:

{{$sample->company->company_name}}

</p>



<p>
Product:

{{$sample->product->product_name}}

</p>



<p>
Batch Number:

{{$sample->batch_number}}

</p>



<p>
Sample Date:

{{$sample->sample_date}}

</p>



<p>
Quantity:

{{$sample->quantity}}

</p>



<p>
Status:

{{$sample->status}}

</p>


</div>

</div>


@endsection