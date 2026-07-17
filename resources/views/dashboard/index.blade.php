@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-4">

        <div>

           <div>
    <h2 class="fw-bold mb-1">
        Dashboard
    </h2>

    <p class="text-muted mb-0">
        Welcome back,
        <strong>{{ auth()->user()->name }}</strong>
    </p>
</div>

            <small class="text-muted">

              Welcome

<strong>

{{ auth()->user()->name }}

</strong>

to

<strong>

{{ $appSetting->company_name ?? 'QA/QC Management' }}

</strong>

            </small>

        </div>

        <div>

            <div class="badge bg-primary fs-6 p-3">

<i class="bi bi-calendar-event"></i>

{{ now()->format('d M Y') }}

</div>

        </div>

    </div>


    <div class="row">

     <div class="col-xl-3 col-lg-6 col-md-6 mb-4">

    <div class="card border-0 shadow h-100">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted">
                        Total Companies
                    </small>

                    <h2 class="fw-bold mt-2">
                        {{ $companies }}
                    </h2>

                </div>

                <div class="bg-primary rounded-circle p-3">

                    <i class="bi bi-building text-white fs-3"></i>

                </div>

            </div>

        </div>

    </div>

</div>



        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">

<div class="card border-0 shadow h-100">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<small class="text-muted">

Products

</small>

<h2 class="fw-bold">

{{ $products }}

</h2>

</div>

<div class="bg-success rounded-circle p-3">

<i class="bi bi-box text-white fs-3"></i>

</div>

</div>

</div>

</div>

</div>
<div class="col-xl-3 col-lg-6 col-md-6 mb-4">

<div class="card border-0 shadow h-100">

<div class="card-body">

<div class="d-flex justify-content-between">

<div>

<small class="text-muted">

Samples

</small>

<h2 class="fw-bold">

{{ $samples }}

</h2>

</div>

<div class="bg-warning rounded-circle p-3">

<i class="bi bi-beaker text-white fs-3"></i>

</div>

</div>

</div>

</div>

</div>
       <div class="col-xl-3 col-lg-6 col-md-6 mb-4">

    <div class="card border-0 shadow h-100">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted">
                        Users
                    </small>

                    <h2 class="fw-bold">
                        {{ $users }}
                    </h2>

                </div>

                <div class="bg-danger rounded-circle p-3">

                    <i class="bi bi-people text-white fs-3"></i>

                </div>

            </div>

        </div>

    </div>

</div>
    </div>



    <div class="row">

       <div class="col-xl-4 col-md-6 mb-4">

<div class="card border-0 shadow h-100">

<div class="card-body d-flex justify-content-between align-items-center">

<div>

<small class="text-muted">
Pending Tests
</small>

<h2>{{ $pendingTests }}</h2>

</div>

<div class="bg-warning rounded-circle p-3">

<i class="bi bi-hourglass-split text-white fs-3"></i>

</div>

</div>

</div>

</div>

        <div class="col-xl-4 col-md-6 mb-4">

<div class="card border-0 shadow h-100">

<div class="card-body d-flex justify-content-between align-items-center">

<div>

<small class="text-muted">
Approved Samples
</small>

<h2>{{ $approvedSamples }}</h2>

</div>

<div class="bg-success rounded-circle p-3">

<i class="bi bi-check-circle text-white fs-3"></i>

</div>

</div>

</div>

</div>

       <div class="col-xl-4 col-md-12 mb-4">

<div class="card border-0 shadow h-100">

<div class="card-body d-flex justify-content-between align-items-center">

<div>

<small class="text-muted">
Rejected Samples
</small>

<h2>{{ $rejectedSamples }}</h2>

</div>

<div class="bg-danger rounded-circle p-3">

<i class="bi bi-x-circle text-white fs-3"></i>

</div>

</div>

</div>

</div>

    </div>

<div class="col-md-3 mb-4">

<div class="card shadow h-100">

<div class="card-body text-center">

<i class="bi bi-bar-chart fs-1 text-primary"></i>

<h5 class="mt-3">
Reports
</h5>

<a href="{{ route('reports.index') }}"
class="btn btn-primary mt-2">

Open Reports

</a>

</div>

</div>

</div>

    <br>



    <div class="row">

        <div class="col-lg-6 mb-4">

            <div class="card shadow">

                <div class="card-header">

                    Sample Status

                </div>

                <div class="card-body">

                    <canvas id="sampleChart"></canvas>

                </div>

            </div>

        </div>



       <div class="col-lg-6 mb-4">

            <div class="card shadow">

                <div class="card-header">

                    Test Status

                </div>

                <div class="card-body">

                    <canvas id="testChart"></canvas>

                </div>

            </div>

        </div>

    </div>



    <br>



    <div class="card shadow">

        <div class="card-header">

            Recent Samples

        </div>

        <div class="card-body">

            <div class="table-responsive">

<table class="table table-hover table-striped align-middle">

                <thead>

                <tr>

                    <th>Sample</th>

                    <th>Company</th>

                    <th>Product</th>

                    <th>Status</th>

                </tr>

                </thead>

                <tbody>

                @foreach($recentSamples as $sample)

                <tr>

                    <td>{{ $sample->sample_number }}</td>

                    <td>{{ $sample->company->company_name }}</td>

                    <td>{{ $sample->product->product_name }}</td>

                   <td>

@if($sample->qa_status=='Approved')

<span class="badge bg-success">
Approved
</span>

@elseif($sample->qa_status=='Pending')

<span class="badge bg-warning text-dark">
Pending
</span>

@else

<span class="badge bg-danger">
Rejected
</span>

@endif

</td>

                </tr>

                @endforeach

                </tbody>

            </table>
            </div>

        </div>

    </div>



    <br>



    <div class="card shadow border-0">

        <div class="card-header">

            Recent Activities

        </div>

        <div class="card-body">

           <div class="table-responsive">

<table class="table table-hover table-striped align-middle">

                <thead>

                <tr>

                    <th>User</th>

                    <th>Action</th>

                    <th>Module</th>

                    <th>Description</th>

                    <th>Date</th>

                </tr>

                </thead>

                <tbody>

                @foreach($activities as $activity)

                <tr>

                    <td>

                        {{ $activity->user->name ?? '-' }}

                    </td>

                    <td>

@if($activity->action=="Create")

<span class="badge bg-success">
Create
</span>

@elseif($activity->action=="Update")

<span class="badge bg-primary">
Update
</span>

@elseif($activity->action=="Delete")

<span class="badge bg-danger">
Delete
</span>

@else

<span class="badge bg-secondary">
{{ $activity->action }}
</span>

@endif

</td>

                    <td>

                        {{ $activity->module }}

                    </td>

                    <td>

                        {{ $activity->description }}

                    </td>

                    <td>

                        {{ $activity->created_at->format('d M Y h:i A') }}

                    </td>

                </tr>

                @endforeach

                </tbody>

            </table>
            </div>

        </div>

    </div>

</div>

@endsection



@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(document.getElementById('sampleChart'),{

type:'pie',

data:{

labels:['Approved','Pending','Rejected'],

datasets:[{

backgroundColor:[
'#198754',
'#ffc107',
'#dc3545'
],

borderWidth:0,

hoverOffset:10,

data:[

{{ $sampleStatus['Approved'] }},

{{ $sampleStatus['Pending'] }},

{{ $sampleStatus['Rejected'] }}

]

}]

}

});



new Chart(document.getElementById('testChart'),{

type:'bar',

data:{
    options:{
responsive:true,
maintainAspectRatio:false
}

labels:['Completed','Pending','Rejected'],

datasets:[{

backgroundColor:[
'#0d6efd',
'#ffc107',
'#dc3545'
],

borderRadius:10

data:[

{{ $testStatus['Completed'] }},

{{ $testStatus['Pending'] }},

{{ $testStatus['Rejected'] }}

]

}]

}

});

</script>

@endsection