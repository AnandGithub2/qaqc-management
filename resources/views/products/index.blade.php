@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2>Products</h2>

    <a href="{{ route('products.create') }}" class="btn btn-primary">
        + Add Product
    </a>

</div>

<div class="card shadow">

    <div class="card-body">

        <form method="GET" action="{{ route('products.index') }}" class="row mb-3">

            <div class="col-md-5">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Search Product Name, Code or Category">

            </div>

            <div class="col-md-3">

                <button class="btn btn-primary">
                    Search
                </button>

                <a href="{{ route('products.index') }}"
                   class="btn btn-secondary">

                    Reset

                </a>

            </div>

            <div class="col-md-4 text-end">

                <b>Total Records :</b>

                {{ $products->total() }}

            </div>

        </form>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

            <tr>

                <th>Code</th>

                <th>Product Name</th>

                <th>Company</th>

                <th>Category</th>

                <th>Status</th>

                <th width="220">Action</th>

            </tr>

            </thead>

            <tbody>

            @forelse($products as $product)

                <tr>

                    <td>{{ $product->product_code }}</td>

                    <td>{{ $product->product_name }}</td>

                    <td>{{ $product->company->company_name }}</td>

                    <td>{{ $product->category }}</td>

                    <td>

                        @if($product->status)

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

                        <a href="{{ route('products.show',$product->id) }}"
                           class="btn btn-info btn-sm">

                            View

                        </a>

                        <a href="{{ route('products.edit',$product->id) }}"
                           class="btn btn-warning btn-sm">

                            Edit

                        </a>

                        <form
                            action="{{ route('products.destroy',$product->id) }}"
                            method="POST"
                            class="d-inline">

                            @csrf

                            @method('DELETE')

                            <button
                                onclick="return confirm('Delete Product?')"
                                class="btn btn-danger btn-sm">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        No Products Found

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $products->links() }}

        </div>

    </div>

</div>

@endsection