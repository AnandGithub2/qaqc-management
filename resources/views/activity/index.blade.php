@extends('layouts.app')

@section('content')

<div class="container">

<h3 class="mb-4">
Activity Logs
</h3>

<table class="table table-bordered table-striped">

<thead>

<tr>

<th>ID</th>

<th>User</th>

<th>Action</th>

<th>Module</th>

<th>Description</th>

<th>Date</th>

</tr>

</thead>

<tbody>

@foreach($logs as $log)

<tr>

<td>{{ $log->id }}</td>

<td>{{ $log->user->name ?? '-' }}</td>

<td>{{ $log->action }}</td>

<td>{{ $log->module }}</td>

<td>{{ $log->description }}</td>

<td>{{ $log->created_at }}</td>

</tr>

@endforeach

</tbody>

</table>

{{ $logs->links() }}

</div>

@endsection