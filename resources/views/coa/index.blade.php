@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold text-danger mb-0">
                Certificate Of Analysis
            </h2>

            <small class="text-muted">
                All Generated COA Certificates
            </small>
        </div>

    </div>

    <div class="card shadow border-0">

        <div class="card-header bg-danger text-white">

            <h5 class="mb-0">
                COA List
            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-danger">

                        <tr>

                            <th>#</th>
                            <th>COA Number</th>
                            <th>Company</th>
                            <th>Product</th>
                            <th>Sample No.</th>
                            <th>Batch No.</th>
                            <th>Issue Date</th>
                            <th>Status</th>
                            <th width="170">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse($coas as $coa)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong class="text-danger">
                                    {{ $coa->coa_number }}
                                </strong>
                            </td>

                            <td>
                                {{ $coa->sample->company->company_name ?? '-' }}
                            </td>

                            <td>
                                {{ $coa->sample->product->product_name ?? '-' }}
                            </td>

                            <td>
                                {{ $coa->sample->sample_number ?? '-' }}
                            </td>

                            <td>
                                {{ $coa->sample->batch_number ?? '-' }}
                            </td>

                            <td>

                                {{ \Carbon\Carbon::parse($coa->issue_date)->format('d-m-Y') }}

                            </td>

                            <td>

                                @if($coa->sample->qa_status=="Approved")

                                    <span class="badge bg-success">
                                        Approved
                                    </span>

                                @elseif($coa->sample->qa_status=="Rejected")

                                    <span class="badge bg-danger">
                                        Rejected
                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('coa.generate',$coa->sample->id) }}"
                                   class="btn btn-danger btn-sm">

                                    <i class="bi bi-file-earmark-pdf"></i>

                                </a>

                                <a href="{{ route('coa.mail',$coa->sample->id) }}"
                                   class="btn btn-success btn-sm">

                                    <i class="bi bi-envelope"></i>

                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center text-muted">

                                No COA Found

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