@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2>Companies</h2>

    @can('manage companies')
    <a href="{{ route('companies.create') }}" class="btn btn-primary">
        + Add Company
    </a>
    @endcan

</div>

<div class="card shadow">

    <div class="card-body">

        <form method="GET" action="{{ route('companies.index') }}" class="row mb-3">

            <div class="col-md-5">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Search Company Name, Code, Email or Phone">

            </div>

            <div class="col-md-3">

                <button class="btn btn-primary">
                    Search
                </button>

                <a href="{{ route('companies.index') }}"
                   class="btn btn-secondary">
                    Reset
                </a>

            </div>

            <div class="col-md-4 text-end">

                <b>Total Records :</b>

                {{ $companies->total() }}

            </div>

        </form>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>Code</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Status</th>

                    <th width="220">Action</th>

                </tr>

            </thead>

            <tbody>

            @forelse($companies as $company)

                <tr>

                    <td>{{ $company->company_code }}</td>

                    <td>{{ $company->company_name }}</td>

                    <td>{{ $company->email }}</td>

                    <td>

                        @if($company->status)

                            <span class="badge bg-success">
                                Active
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Inactive
                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('companies.show',$company->id) }}"
                           class="btn btn-info btn-sm">

                            View

                        </a>

                        @can('manage companies')

                        <a href="{{ route('companies.edit',$company->id) }}"
                           class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <form
                            action="{{ route('companies.destroy',$company->id) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete Company?')">

                                Delete

                            </button>

                        </form>

                        @endcan

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="text-center">

                        No Companies Found

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $companies->links() }}

        </div>

    </div>

</div>

@endsection