@extends('layouts.app')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}

    <div class="row mb-4">

        <div class="col-lg-8">

            <h2 class="fw-bold mb-1">
                Dashboard
            </h2>

            <p class="text-muted">

                Welcome back,

                <strong>{{ auth()->user()->name }}</strong>

                <br>

                {{ $appSetting->company_name ?? 'QA/QC ERP Management System' }}

            </p>

        </div>

        <div class="col-lg-4 text-end">

            <div class="badge bg-dark fs-6 px-4 py-3">

                <i class="bi bi-calendar-event"></i>

                {{ now()->format('d M Y') }}

            </div>

        </div>

    </div>

    {{-- KPI CARDS --}}

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-0 shadow">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">

                                Companies

                            </small>

                            <h2 class="fw-bold">

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

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-0 shadow">

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

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-0 shadow">

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

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-0 shadow">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

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

    {{-- TODAY ANALYTICS --}}

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-start border-5 border-primary shadow">

                <div class="card-body">

                    <small class="text-muted">

                        Today's Samples

                    </small>

                    <h2 class="fw-bold">

                        {{ $todaySamples }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-start border-5 border-success shadow">

                <div class="card-body">

                    <small class="text-muted">

                        Today Approved

                    </small>

                    <h2 class="fw-bold text-success">

                        {{ $todayApproved }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-start border-5 border-warning shadow">

                <div class="card-body">

                    <small class="text-muted">

                        Approval Rate

                    </small>

                    <h2 class="fw-bold text-warning">

                        {{ $approvalRate }}%

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-start border-5 border-danger shadow">

                <div class="card-body">

                    <small class="text-muted">

                        Total COA

                    </small>

                    <h2 class="fw-bold text-danger">

                        {{ $totalCOA }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

        {{-- QUICK ACTIONS --}}

    <div class="row mb-4">

        <div class="col-lg-3 col-md-6 mb-3">

            <a href="{{ route('samples.create') }}" class="text-decoration-none">

                <div class="card shadow border-0 h-100">

                    <div class="card-body text-center">

                        <i class="bi bi-plus-circle-fill text-primary display-5"></i>

                        <h5 class="mt-3">New Sample</h5>

                    </div>

                </div>

            </a>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <a href="{{ route('sample-tests.index') }}" class="text-decoration-none">

                <div class="card shadow border-0 h-100">

                    <div class="card-body text-center">

                        <i class="bi bi-clipboard2-data-fill text-success display-5"></i>

                        <h5 class="mt-3">Laboratory Tests</h5>

                    </div>

                </div>

            </a>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <a href="{{ route('qa.index') }}" class="text-decoration-none">

                <div class="card shadow border-0 h-100">

                    <div class="card-body text-center">

                        <i class="bi bi-check-circle-fill text-warning display-5"></i>

                        <h5 class="mt-3">QA Approval</h5>

                    </div>

                </div>

            </a>

        </div>

        <div class="col-lg-3 col-md-6 mb-3">

            <a href="{{ route('reports.index') }}" class="text-decoration-none">

                <div class="card shadow border-0 h-100">

                    <div class="card-body text-center">

                        <i class="bi bi-bar-chart-fill text-danger display-5"></i>

                        <h5 class="mt-3">Reports</h5>

                    </div>

                </div>

            </a>

        </div>

    </div>


    {{-- CHARTS --}}

    <div class="row">

        <div class="col-lg-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-header bg-primary text-white">

                    Sample Status

                </div>

                <div class="card-body">

                    <canvas id="sampleChart" height="220"></canvas>

                </div>

            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-header bg-success text-white">

                    Test Status

                </div>

                <div class="card-body">

                    <canvas id="testChart" height="220"></canvas>

                </div>

            </div>

        </div>

    </div>


    {{-- MONTHLY TREND & RECENT COA --}}

    <div class="row">

        <div class="col-lg-8 mb-4">

            <div class="card shadow border-0">

                <div class="card-header bg-dark text-white">

                    Monthly Sample Trend

                </div>

                <div class="card-body">

                    <canvas id="monthlyChart" height="120"></canvas>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="card shadow border-0">

                <div class="card-header bg-info text-white">

                    Recent COA

                </div>

                <div class="card-body">

                    @forelse($recentCOA as $coa)

                        <div class="border-bottom mb-3 pb-2">

                            <strong>{{ $coa->coa_number }}</strong>

                            <br>

                            <small class="text-muted">

                                {{ optional($coa->sample)->sample_number }}

                            </small>

                        </div>

                    @empty

                        <p class="text-muted">

                            No COA Generated

                        </p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>


    {{-- TOP COMPANY & PRODUCT --}}

    <div class="row">

        <div class="col-lg-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-header bg-warning">

                    Top Companies

                </div>

                <div class="card-body">

                    <table class="table table-striped">

                        <thead>

                        <tr>

                            <th>Company</th>

                            <th>Samples</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($companyStats as $company)

                            <tr>

                                <td>{{ $company->company_name }}</td>

                                <td>{{ $company->samples_count }}</td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-header bg-danger text-white">

                    Top Products

                </div>

                <div class="card-body">

                    <table class="table table-striped">

                        <thead>

                        <tr>

                            <th>Product</th>

                            <th>Samples</th>

                        </tr>

                        </thead>

                        <tbody>

                        @foreach($productStats as $product)

                            <tr>

                                <td>{{ $product->product_name }}</td>

                                <td>{{ $product->samples_count }}</td>

                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

        {{-- RECENT SAMPLES --}}

    <div class="row">

        <div class="col-lg-8 mb-4">

            <div class="card shadow border-0">

                <div class="card-header bg-primary text-white d-flex justify-content-between">

                    <span>Recent Samples</span>

                    <a href="{{ route('samples.index') }}" class="btn btn-sm btn-light">
                        View All
                    </a>

                </div>

                <div class="card-body p-0">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">

                            <tr>

                                <th>Sample</th>

                                <th>Company</th>

                                <th>Product</th>

                                <th>Status</th>

                            </tr>

                            </thead>

                            <tbody>

                            @forelse($recentSamples as $sample)

                                <tr>

                                    <td>

                                        <strong>{{ $sample->sample_number }}</strong>

                                        <br>

                                        <small class="text-muted">

                                            {{ $sample->batch_number }}

                                        </small>

                                    </td>

                                    <td>

                                        {{ $sample->company->company_name }}

                                    </td>

                                    <td>

                                        {{ $sample->product->product_name }}

                                    </td>

                                    <td>

                                        @if($sample->qa_status=="Approved")

                                            <span class="badge bg-success">

                                                Approved

                                            </span>

                                        @elseif($sample->qa_status=="Rejected")

                                            <span class="badge bg-danger">

                                                Rejected

                                            </span>

                                        @else

                                            <span class="badge bg-warning text-dark">

                                                Pending

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="text-center">

                                        No Sample Found

                                    </td>

                                </tr>

                            @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

        {{-- RECENT USERS --}}

        <div class="col-lg-4 mb-4">

            <div class="card shadow border-0">

                <div class="card-header bg-success text-white">

                    Recent Users

                </div>

                <div class="card-body">

                    @forelse($recentUsers as $user)

                        <div class="d-flex justify-content-between border-bottom py-2">

                            <div>

                                <strong>{{ $user->name }}</strong>

                                <br>

                                <small class="text-muted">

                                    {{ $user->email }}

                                </small>

                            </div>

                            <div>

                                <i class="bi bi-person-circle fs-3 text-success"></i>

                            </div>

                        </div>

                    @empty

                        <p>No Users Found</p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>


    {{-- ACTIVITY LOG --}}

    <div class="card shadow border-0 mb-5">

        <div class="card-header bg-dark text-white d-flex justify-content-between">

            <span>Recent Activities</span>

            <a href="{{ route('activity.index') }}" class="btn btn-sm btn-light">

                View All

            </a>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-striped table-hover align-middle mb-0">

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

                    @forelse($activities as $activity)

                        <tr>

                            <td>

                                {{ optional($activity->user)->name }}

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

                    @empty

                        <tr>

                            <td colspan="5" class="text-center">

                                No Activity Found

                            </td>

                        </tr>

                    @endforelse

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

//
// SAMPLE STATUS
//

new Chart(document.getElementById('sampleChart'),{

    type:'doughnut',

    data:{

        labels:[
            'Approved',
            'Pending',
            'Rejected'
        ],

        datasets:[{

            data:[
                {{ $sampleStatus['Approved'] }},
                {{ $sampleStatus['Pending'] }},
                {{ $sampleStatus['Rejected'] }}
            ],

            backgroundColor:[
                '#198754',
                '#ffc107',
                '#dc3545'
            ],

            borderWidth:0

        }]

    },

    options:{

        responsive:true,

        plugins:{

            legend:{
                position:'bottom'
            }

        }

    }

});


//
// TEST STATUS
//

new Chart(document.getElementById('testChart'),{

    type:'bar',

    data:{

        labels:[
            'Completed',
            'Pending',
            'Rejected'
        ],

        datasets:[{

            label:'Tests',

            data:[
                {{ $testStatus['Completed'] }},
                {{ $testStatus['Pending'] }},
                {{ $testStatus['Rejected'] }}
            ],

            backgroundColor:[
                '#0d6efd',
                '#ffc107',
                '#dc3545'
            ],

            borderRadius:8

        }]

    },

    options:{

        responsive:true,

        scales:{

            y:{
                beginAtZero:true
            }

        }

    }

});


//
// MONTHLY SAMPLE TREND
//

new Chart(document.getElementById('monthlyChart'),{

    type:'line',

    data:{

        labels:[
            @foreach($monthlySamples as $month)
                "{{ \Carbon\Carbon::create()->month($month->month)->format('M') }}",
            @endforeach
        ],

        datasets:[{

            label:'Samples',

            data:[
                @foreach($monthlySamples as $month)
                    {{ $month->total }},
                @endforeach
            ],

            borderColor:'#0d6efd',

            backgroundColor:'rgba(13,110,253,.15)',

            fill:true,

            tension:.4

        }]

    },

    options:{

        responsive:true,

        plugins:{

            legend:{
                display:false
            }

        },

        scales:{

            y:{
                beginAtZero:true
            }

        }

    }

});

</script>

@endsection