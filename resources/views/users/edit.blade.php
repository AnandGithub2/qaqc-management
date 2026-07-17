@extends('layouts.app')

@section('content')

<div class="container">

<div class="card shadow">

<div class="card-header">

<h3>Edit User</h3>

</div>

<div class="card-body">

<form action="{{ route('users.update',$user->id) }}"
method="POST">

@csrf

@method('PUT')

<div class="mb-3">

<label>Name</label>

<input
type="text"
name="name"
class="form-control"
value="{{ old('name',$user->name) }}">

</div>


<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="{{ old('email',$user->email) }}">

</div>


<div class="mb-3">

<label>New Password</label>

<input
type="password"
name="password"
class="form-control">

<small class="text-muted">

Leave blank if you don't want to change password.

</small>

</div>


<div class="mb-3">

<label>Role</label>

<select
name="role"
class="form-control">

@foreach($roles as $role)

<option
value="{{ $role->name }}"
{{ $user->hasRole($role->name) ? 'selected' : '' }}>

{{ $role->name }}

</option>

@endforeach

</select>

</div>


<button
class="btn btn-success">

Update User

</button>

<a
href="{{ route('users.index') }}"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

@endsection