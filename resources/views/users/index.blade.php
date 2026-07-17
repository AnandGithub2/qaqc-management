@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

<h2>User Management</h2>

<a href="{{ route('users.create') }}"
class="btn btn-primary">

+ Add User

</a>

</div>

<div class="card shadow">

<div class="card-body">

<form method="GET"
action="{{ route('users.index') }}"
class="row mb-3">

<div class="col-md-5">

<input
type="text"
name="search"
value="{{ request('search') }}"
class="form-control"
placeholder="Search Name or Email">

</div>

<div class="col-md-3">

<button class="btn btn-primary">

Search

</button>

<a href="{{ route('users.index') }}"
class="btn btn-secondary">

Reset

</a>

</div>

<div class="col-md-4 text-end">

<b>Total Users :</b>

{{ $users->total() }}

</div>

</form>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>Name</th>

<th>Email</th>

<th>Role</th>

<th>Action</th>

</tr>

</thead>

<tbody>

@forelse($users as $user)

<tr>

<td>{{ $user->name }}</td>

<td>{{ $user->email }}</td>

<td>

@foreach($user->roles as $role)

<span class="badge bg-success">
{{ $role->name }}
</span>

@endforeach

</td>

<td>

<a href="{{ route('users.edit',$user->id) }}"
class="btn btn-warning btn-sm">
Edit
</a>

@if(auth()->id() != $user->id)

<form
action="{{ route('users.destroy',$user->id) }}"
method="POST"
class="d-inline">

@csrf
@method('DELETE')

<button
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this user?')">

Delete

</button>

</form>

@endif

</td>

</tr>

@empty

<tr>

<td colspan="4" class="text-center">

No Users Found

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="mt-3">

{{ $users->links() }}

</div>

</div>

</div>

@endsection