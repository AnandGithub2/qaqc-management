@extends('layouts.app')


@section('content')


<div class="container">


<h3 class="mb-4">

Notifications

</h3>



<div class="card shadow">


<div class="card-body">


@forelse($notifications as $notification)


<div class="border-bottom p-3">


<h5>

{{ $notification->title }}

@if(!$notification->is_read)

<span class="badge bg-danger">
New
</span>

@endif


</h5>


<p>

{{ $notification->message }}

</p>


<a href="{{ route('notifications.read',$notification->id) }}"
class="btn btn-sm btn-primary">

Open

</a>


</div>


@empty


<p class="text-muted">

No Notifications

</p>


@endforelse


</div>

</div>


</div>


@endsection