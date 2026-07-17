<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<title>Sample Report</title>

<style>

body{
font-family:DejaVu Sans,sans-serif;
font-size:11px;
}

h2{
text-align:center;
margin-bottom:20px;
}

table{
width:100%;
border-collapse:collapse;
}

table,th,td{
border:1px solid #000;
}

th{
background:#efefef;
}

th,td{
padding:6px;
text-align:left;
}

</style>

</head>

<body>

<h2>

Sample Report

</h2>

<table>

<tr>

<th>#</th>

<th>Sample</th>

<th>Company</th>

<th>Product</th>

<th>Batch</th>

<th>Date</th>

<th>Status</th>

</tr>

@foreach($samples as $sample)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $sample->sample_number }}</td>

<td>{{ $sample->company->company_name }}</td>

<td>{{ $sample->product->product_name }}</td>

<td>{{ $sample->batch_number }}</td>

<td>{{ \Carbon\Carbon::parse($sample->sample_date)->format('d-m-Y') }}</td>

<td>{{ $sample->qa_status }}</td>

</tr>

@endforeach

</table>

</body>

</html>