@extends('layouts.app')


@section('content')


<h2>
Company Details
</h2>


<div class="card shadow">

<div class="card-body">


<h4>
{{$company->company_name}}
</h4>


<p>
Code:
{{$company->company_code}}
</p>


<p>
Email:
{{$company->email}}
</p>


<p>
Phone:
{{$company->phone}}
</p>


<p>
GST:
{{$company->gst_number}}
</p>


<p>
Address:
{{$company->address}}
</p>


<p>
Country:
{{$company->country}}
</p>


</div>

</div>


@endsection