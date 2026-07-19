<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<title>Certificate Of Analysis</title>

<style>

body{
    font-family: DejaVu Sans, sans-serif;
    font-size:12px;
    color:#222;
    margin:25px;
}

table{
    width:100%;
    border-collapse:collapse;
}

td,th{
    border:1px solid #444;
    padding:7px;
}

th{
    background:#e9ecef;
}

.header-table td{
    border:none;
}

.logo{
    width:80px;
    height:80px;
}

.company-name{
    font-size:22px;
    font-weight:bold;
}

.company-details{
    font-size:11px;
}

.coa-title{

    margin-top:15px;
    background:#dc3545;
    color:#fff;
    text-align:center;
    padding:10px;
    font-size:20px;
    font-weight:bold;

}

.section{

    margin-top:18px;
    margin-bottom:8px;
    font-size:15px;
    font-weight:bold;
    color:#dc3545;

}


.pass{
    color:green;
    font-weight:bold;
}


.fail{
    color:red;
    font-weight:bold;
}


.footer{

    margin-top:50px;

}


.sign{

    width:33%;
    text-align:center;
    float:left;

}


.note{

    margin-top:90px;
    font-size:11px;
    color:#555;
    border-top:1px solid #999;
    padding-top:10px;

}


</style>


</head>


<body>


{{-- HEADER --}}


<table class="header-table">

<tr>


<td width="18%">


@if(isset($setting) && $setting->company_logo)


<img
class="logo"
src="{{ public_path('storage/'.$setting->company_logo) }}">


@endif


</td>



<td align="center">


<div class="company-name">

{{ $setting->company_name ?? 'QA/QC MANAGEMENT SYSTEM' }}

</div>


<div class="company-details">


{{ $setting->address ?? '' }}

<br>


{{ $setting->phone ?? '' }}


|

{{ $setting->email ?? '' }}


<br>


GST :
{{ $setting->gst_number ?? '-' }}


</div>


</td>



<td width="20%" align="right">


<b>Revision :</b> 01

<br>

<b>Page :</b> 1 of 1


</td>


</tr>


</table>



<div class="coa-title">


CERTIFICATE OF ANALYSIS (COA)


</div>



{{-- COA INFORMATION --}}


<div class="section">

COA Information

</div>


<table>


<tr>


<th width="20%">
COA Number
</th>


<td>

{{ $sample->coa->coa_number ?? '-' }}

</td>



<th width="20%">
Issue Date
</th>


<td>


{{ $sample->coa && $sample->coa->issue_date 
? \Carbon\Carbon::parse($sample->coa->issue_date)->format('d-m-Y')
: now()->format('d-m-Y') }}


</td>


</tr>


</table>




{{-- SAMPLE INFORMATION --}}


<div class="section">

Sample Information

</div>



<table>


<tr>

<th width="25%">
Company
</th>

<td>

{{ $sample->company->company_name ?? '-' }}

</td>

</tr>



<tr>

<th>
Product
</th>

<td>

{{ $sample->product->product_name ?? '-' }}

</td>

</tr>



<tr>

<th>
Batch Number
</th>

<td>

{{ $sample->batch_number }}

</td>

</tr>



<tr>

<th>
Sample Number
</th>

<td>

{{ $sample->sample_number }}

</td>

</tr>



<tr>

<th>
Sample Date
</th>

<td>

{{ \Carbon\Carbon::parse($sample->sample_date)->format('d-m-Y') }}

</td>

</tr>


</table>




{{-- TEST RESULTS --}}



<div class="section">

Test Results

</div>



<table>


<tr>


<th>
Sr.
</th>


<th>
Code
</th>


<th>
Test Parameter
</th>


<th>
Specification
</th>


<th>
Result
</th>


<th>
Unit
</th>


<th>
Status
</th>


</tr>



@php

$overall = 'PASS';

@endphp




@foreach($sample->sampleTests as $test)



@if(strtoupper($test->test_status) == 'FAIL')

@php

$overall='FAIL';

@endphp

@endif



<tr>


<td>

{{ $loop->iteration }}

</td>


<td>

{{ $test->testParameter->test_code ?? '-' }}

</td>


<td>

{{ $test->testParameter->test_name ?? '-' }}

</td>


<td>

{{ $test->testParameter->specification ?? '-' }}

</td>


<td>

{{ $test->result }}

</td>


<td>

{{ $test->testParameter->unit ?? '-' }}

</td>


<td>

{{ $test->test_status }}

</td>


</tr>



@endforeach



</table>





{{-- FINAL RESULT --}}



<div class="section">

Final Result

</div>



<table>


<tr>


<th width="30%">
Overall Status
</th>


<td>



@if($overall=="PASS")


<span class="pass">

PASS

</span>



@else


<span class="fail">

FAIL

</span>


@endif


</td>


</tr>


</table>





{{-- APPROVAL DETAILS --}}


<div class="section">

Approval Details

</div>



<table>



<tr>


<th width="25%">
QA Status
</th>


<td>

{{ $sample->qa_status }}

</td>


</tr>




<tr>


<th>
Prepared By
</th>


<td>

{{ $sample->coa->prepared_by ?? '-' }}

</td>


</tr>




<tr>


<th>
Approved By
</th>


<td>

{{ $sample->coa->approved_by ?? '-' }}

</td>


</tr>




<tr>


<th>
Remarks
</th>


<td>

{{ $sample->coa->remarks ?? '-' }}

</td>


</tr>



</table>





{{-- SIGNATURE --}}



<div class="footer">


<div class="sign">


<br><br><br>


____________________


<br>

Prepared By


</div>




<div class="sign">


<br><br><br>


____________________


<br>

Reviewed By


</div>




<div class="sign">


<br><br><br>


____________________


<br>

Authorized Signatory


</div>


</div>




<div style="clear:both;"></div>




<div class="note">


This Certificate of Analysis is computer generated and does not require a physical signature.

<br>

The above results relate only to the sample tested.


</div>



</body>

</html>