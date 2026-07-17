@extends('layouts.app')


@section('content')


<h2>
Audit Trail
</h2>


<div class="card shadow">

<div class="card-body">


<table class="table table-bordered">


<tr>

<th>User</th>

<th>Module</th>

<th>Action</th>

<th>Record ID</th>

<th>Date</th>

<th>IP</th>

</tr>



@foreach($audits as $audit)


<tr>


<td>

{{ $audit->user?->name ?? 'System' }}

</td>


<td>

{{ $audit->module }}

</td>


<td>

{{ $audit->action }}

</td>


<td>

{{ $audit->record_id }}

</td>


<td>

{{ $audit->created_at }}

</td>


<td>

{{ $audit->ip_address }}

</td>


</tr>


@endforeach


</table>


</div>

</div>


@endsection