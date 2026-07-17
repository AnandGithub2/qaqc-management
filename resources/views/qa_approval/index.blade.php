@extends('layouts.app')

@section('content')

<h2 class="mb-3">QA Approval Dashboard</h2>

<div class="card shadow">

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead>

            <tr>

                <th>Sample</th>
                <th>Company</th>
                <th>Product</th>
                <th>Tests</th>
                <th>Status</th>
                <th>Action</th>
                <th>Approval Details</th>

            </tr>

            </thead>

            <tbody>

            @foreach($samples as $sample)

            <tr>

                <td>{{ $sample->sample_number }}</td>

                <td>{{ $sample->company->company_name }}</td>

                <td>{{ $sample->product->product_name }}</td>

                <td>

                    @foreach($sample->sampleTests as $test)

                        <div>

                            {{ $test->testParameter->test_name }}

                            -

                            {{ $test->test_status }}

                        </div>

                    @endforeach

                </td>

                <td>

                    @if($sample->qa_status=='Approved')

                        <span class="badge bg-success">

                            Approved

                        </span>

                    @elseif($sample->qa_status=='Rejected')

                        <span class="badge bg-danger">

                            Rejected

                        </span>

                    @else

                        <span class="badge bg-warning">

                            Pending

                        </span>

                    @endif

                </td>

                <td>

                    @if($sample->qa_status=='Pending')

                        <form method="POST"
                              action="{{ route('qa.approve',$sample->id) }}">

                            @csrf

                            <textarea
                                name="approval_remarks"
                                class="form-control mb-2"
                                placeholder="Approval Remarks"
                                required></textarea>

                            <button class="btn btn-success btn-sm">

                                Approve

                            </button>

                        </form>

                        <br>

                        <form method="POST"
                              action="{{ route('qa.reject',$sample->id) }}">

                            @csrf

                            <textarea
                                name="approval_remarks"
                                class="form-control mb-2"
                                placeholder="Reject Reason"
                                required></textarea>

                            <button class="btn btn-danger btn-sm">

                                Reject

                            </button>

                        </form>

                    @else

                        <span class="badge bg-secondary">

                            Locked

                        </span>

                        @if($sample->qa_status=='Approved')

<br>

<a href="{{route('coa.create',$sample->id)}}"
class="btn btn-primary btn-sm mt-2">

Generate COA

</a>

@endif

                    @endif

                </td>

                <td>

                    <b>Status :</b>

                    {{ $sample->qa_status }}

                    <br><br>

                    <b>Approved By :</b>

                    {{ $sample->approvedBy?->name ?? '-' }}

                    <br>

                    <b>Date :</b>

                    {{ $sample->approval_date ?? '-' }}

                    <br>

                    <b>Remarks :</b>

                    {{ $sample->approval_remarks ?? '-' }}

                </td>

            </tr>

            @endforeach

            </tbody>

        </table>




    </div>

</div>

@endsection