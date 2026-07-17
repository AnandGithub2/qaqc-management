@extends('layouts.app')


@section('content')


<h2>
Create New User
</h2>



<div class="card shadow">


<div class="card-body">



<form method="POST"
action="{{route('users.store')}}">


@csrf



<div class="mb-3">

<label>
Name
</label>

<input 
type="text"
name="name"
class="form-control">

</div>




<div class="mb-3">

<label>
Email
</label>

<input 
type="email"
name="email"
class="form-control">

</div>




<div class="mb-3">

<label>
Password
</label>

<input 
type="password"
name="password"
class="form-control">

</div>





<div class="mb-3">


<label>
Select Role
</label>


<select name="role"
class="form-control">


<option>
Select Role
</option>



@foreach($roles as $role)


<option value="{{$role->name}}">

{{$role->name}}

</option>


@endforeach


</select>


</div>




<button class="btn btn-success">

Create User

</button>



</form>


</div>

</div>


@endsection