@extends('layouts.app')

@section('content')

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4 class="mb-0">

Application Settings

</h4>

</div>

<div class="card-body">

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

<form
action="{{ route('settings.store') }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="row">

<div class="col-md-6 mb-3">

<label>Company Name</label>

<input
type="text"
name="company_name"
class="form-control"
value="{{ $setting->company_name ?? '' }}">

</div>

<div class="col-md-6 mb-3">

<label>Company Logo</label>

<input
type="file"
name="company_logo"
class="form-control">

@if(isset($setting) && $setting->company_logo)

<br>

<img
src="{{ asset('storage/'.$setting->company_logo) }}"
width="120">

@endif

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="{{ $setting->email ?? '' }}">

</div>

<div class="col-md-6 mb-3">

<label>Phone</label>

<input
type="text"
name="phone"
class="form-control"
value="{{ $setting->phone ?? '' }}">

</div>

<div class="col-md-6 mb-3">

<label>Website</label>

<input
type="text"
name="website"
class="form-control"
value="{{ $setting->website ?? '' }}">

</div>

<div class="col-md-6 mb-3">

<label>GST Number</label>

<input
type="text"
name="gst_number"
class="form-control"
value="{{ $setting->gst_number ?? '' }}">

</div>

<div class="col-md-12 mb-3">

<label>Address</label>

<textarea
name="address"
class="form-control"
rows="3">{{ $setting->address ?? '' }}</textarea>

</div>

<div class="col-md-3 mb-3">

<label>City</label>

<input
type="text"
name="city"
class="form-control"
value="{{ $setting->city ?? '' }}">

</div>

<div class="col-md-3 mb-3">

<label>State</label>

<input
type="text"
name="state"
class="form-control"
value="{{ $setting->state ?? '' }}">

</div>

<div class="col-md-3 mb-3">

<label>Country</label>

<input
type="text"
name="country"
class="form-control"
value="{{ $setting->country ?? 'India' }}">

</div>

<div class="col-md-3 mb-3">

<label>Pincode</label>

<input
type="text"
name="pincode"
class="form-control"
value="{{ $setting->pincode ?? '' }}">

</div>

<div class="col-md-12 mb-3">

<label>Footer Text</label>

<input
type="text"
name="footer_text"
class="form-control"
value="{{ $setting->footer_text ?? '' }}">

</div>

<div class="col-md-12">

<button
class="btn btn-success">

Save Settings

</button>

</div>

</div>

</form>

</div>

</div>

</div>

@endsection