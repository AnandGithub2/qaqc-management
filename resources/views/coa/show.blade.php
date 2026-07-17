@extends('layouts.app')

@section('content')

<style>

body{
    background:#eef3f8;
    font-family:Arial,Helvetica,sans-serif;
}

.print-area{
    max-width:950px;
    margin:25px auto;
    border-radius:12px;
    overflow:hidden;
}

.coa-header{
    background:#0d6efd;
    color:#fff;
    padding:25px;
}

.company-logo{
    width:90px;
    height:90px;
    object-fit:contain;
    background:#fff;
    border-radius:8px;
    padding:5px;
}

.company-name{
    font-size:30px;
    font-weight:700;
}

.company-details{
    font-size:14px;
    margin-top:8px;
}

.coa-title{
    text-align:center;
    background:#f8f9fa;
    color:#0d6efd;
    font-size:28px;
    font-weight:bold;
    letter-spacing:1px;
    padding:18px;
    border-bottom:3px solid #0d6efd;
}

.section-title{
    background:#0d6efd;
    color:#fff;
    padding:10px 15px;
    font-size:16px;
    font-weight:600;
    border-radius:5px;
    margin-top:25px;
}

.info-table td{
    padding:10px;
}

.table th{
    background:#0d6efd;
    color:#fff;
    text-align:center;
}

.table td{
    vertical-align:middle;
}

.badge{
    padding:8px 12px;
    font-size:13px;
}

.signature-box{
    margin-top:70px;
}

.signature{
    text-align:center;
}

.signature hr{
    border:1px solid #000;
    opacity:1;
}

.footer-note{
    margin-top:40px;
    text-align:center;
    font-size:12px;
    color:#666;
}

@media(max-width:768px){

.company-name{
font-size:24px;
}

.company-logo{
width:70px;
height:70px;
}

.coa-title{
font-size:22px;
}

}

@media print{

body{
background:#fff !important;
}

.navbar,
.sidebar,
footer,
.btn,
.no-print,
#overlay{
display:none!important;
}

.layout,
.main-content,
.container-fluid{
margin:0!important;
padding:0!important;
width:100%!important;
}

.print-area{
margin:0!important;
max-width:100%!important;
border:none!important;
box-shadow:none!important;
}

.card{
border:none!important;
box-shadow:none!important;
}

@page{
size:A4;
margin:10mm;
}

}

</style>

<div class="container-fluid">

<div class="card shadow print-area">

<div class="card-body p-0">

<div class="text-end p-3 no-print">

<button onclick="window.print()" class="btn btn-success">

<i class="bi bi-printer"></i>

Print COA

</button>

</div>

<div class="coa-header">

<div class="row align-items-center">

<div class="col-md-2 text-center">

@if(isset($appSetting) && $appSetting->company_logo)

<img
src="{{ asset('storage/'.$appSetting->company_logo) }}"
class="company-logo">

@else

<i class="bi bi-building display-2"></i>

@endif

</div>

<div class="col-md-10">

<div class="company-name">

{{ $appSetting->company_name ?? 'QA/QC ERP' }}

</div>

<div class="company-details">

{{ $appSetting->address ?? 'Company Address' }}

<br>

Phone :
{{ $appSetting->phone ?? '-' }}

|

Email :
{{ $appSetting->email ?? '-' }}

</div>

</div>

</div>

</div>

<div class="coa-title">

CERTIFICATE OF ANALYSIS

</div>

<div class="p-4">

<table class="table table-bordered info-table">

<tr>

<td><b>COA Number</b></td>

<td>{{ $sample->coa->coa_number ?? '-' }}</td>

<td><b>Issue Date</b></td>

<td>{{ now()->format('d M Y') }}</td>

</tr>

<tr>

<td><b>Company</b></td>

<td>{{ $sample->company->company_name }}</td>

<td><b>Product</b></td>

<td>{{ $sample->product->product_name }}</td>

</tr>

<tr>

<td><b>Batch No</b></td>

<td>{{ $sample->batch_number }}</td>

<td><b>Sample No</b></td>

<td>{{ $sample->sample_number }}</td>

</tr>

</table>

<div class="section-title">

TEST RESULTS

</div>

<table class="table table-bordered">

<thead>

<tr>

<th width="8%">#</th>

<th>Test Parameter</th>

<th width="20%">Result</th>

<th width="20%">Status</th>

</tr>

</thead>

<tbody>

@foreach($sample->sampleTests as $test)

<tr>

<td align="center">

{{ $loop->iteration }}

</td>

<td>

{{ $test->testParameter->test_name }}

</td>

<td align="center">

{{ $test->result }}

</td>

<td align="center">

@if($test->test_status=="Pass")

<span class="badge bg-success">

PASS

</span>

@elseif($test->test_status=="Fail")

<span class="badge bg-danger">

FAIL

</span>

@else

<span class="badge bg-warning text-dark">

{{ $test->test_status }}

</span>

@endif

</td>

</tr>

@endforeach

</tbody>

</table>

<div class="section-title">

FINAL APPROVAL

</div>

<table class="table table-bordered">

<tr>

<th width="25%">QA Status</th>

<td>

@if($sample->qa_status=="Approved")

<span class="badge bg-success">

APPROVED

</span>

@elseif($sample->qa_status=="Rejected")

<span class="badge bg-danger">

REJECTED

</span>

@else

<span class="badge bg-warning text-dark">

PENDING

</span>

@endif

</td>

</tr>

<tr>

<th>Prepared By</th>

<td>

{{ $sample->coa->prepared_by ?? '-' }}

</td>

</tr>

<tr>

<th>Approved By</th>

<td>

{{ $sample->coa->approved_by ?? '-' }}

</td>

</tr>

<tr>

<th>Approval Date</th>

<td>

{{ optional($sample->approval_date)->format('d M Y h:i A') ?? now()->format('d M Y') }}

</td>

</tr>

<tr>

<th>Remarks</th>

<td>

{{ $sample->coa->remarks ?? 'No Remarks' }}

</td>

</tr>

</table>

<div class="section-title">

SUMMARY

</div>

<table class="table table-bordered">

<tr>

<th width="30%">Total Tests</th>

<td>

{{ $sample->sampleTests->count() }}

</td>

</tr>

<tr>

<th>Passed Tests</th>

<td>

{{ $sample->sampleTests->where('test_status','Pass')->count() }}

</td>

</tr>

<tr>

<th>Failed Tests</th>

<td>

{{ $sample->sampleTests->where('test_status','Fail')->count() }}

</td>

</tr>

<tr>

<th>Overall Result</th>

<td>

@if($sample->qa_status=="Approved")

<span style="color:#198754;font-weight:bold;font-size:16px;">

✔ QUALITY APPROVED

</span>

@elseif($sample->qa_status=="Rejected")

<span style="color:#dc3545;font-weight:bold;font-size:16px;">

✘ QUALITY REJECTED

</span>

@else

<span style="color:#ff9800;font-weight:bold;font-size:16px;">

PENDING APPROVAL

</span>

@endif

</td>

</tr>

</table>

<div class="row signature-box">

<div class="col-4 signature">

<br><br><br>

<hr>

Prepared By

<br>

<small>

{{ $sample->coa->prepared_by ?? '-' }}

</small>

</div>

<div class="col-4 signature">

<br><br><br>

<hr>

QA Manager

<br>

<small>

{{ $sample->coa->approved_by ?? '-' }}

</small>

</div>

<div class="col-4 signature">

<br><br><br>

<hr>

Authorized Signatory

<br>

<small>

{{ $appSetting->company_name ?? 'QA/QC ERP' }}

</small>

</div>

</div>

<hr class="mt-5">

<div class="row">

<div class="col-md-8">

<h6 class="fw-bold text-primary">

Company Information

</h6>

<div>

<strong>{{ $appSetting->company_name ?? 'QA/QC ERP' }}</strong>

</div>

<div>

{{ $appSetting->address ?? '-' }}

</div>

<div>

Phone :

{{ $appSetting->phone ?? '-' }}

</div>

<div>

Email :

{{ $appSetting->email ?? '-' }}

</div>

</div>

<div class="col-md-4 text-end">

<div style="border:2px dashed #0d6efd;padding:15px;border-radius:8px;display:inline-block;">

<strong>

Official Seal

</strong>

<br>

(Stamp Here)

</div>

</div>

</div>

<div class="footer-note">

<hr>

<p>

This Certificate of Analysis (COA) has been electronically generated by

<strong>

{{ $appSetting->company_name ?? 'QA/QC ERP' }}

</strong>.

</p>

<p>

The results mentioned in this certificate are based on laboratory testing performed according to applicable quality procedures.

</p>

<p>

This document is valid without a physical signature.

</p>

<p>

© {{ date('Y') }}

{{ $appSetting->company_name ?? 'QA/QC ERP' }}

| All Rights Reserved

</p>

</div>

</div>

</div>

</div>

</div>

@endsection