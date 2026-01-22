@extends('admin.layouts.master')
@section('title')
    Products Manage
@endsection
@section('body')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Product Module</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Manage</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Product Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            <div class="my-1">
                @can('products.create')
                    <a href="{{ route('products.create') }}">
                        <button class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Product Create"><i
                                class="fa-solid fa-square-plus"></i> Add </button>
                    </a>
                @endcan
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Products Information</h4>
                    <!--Nayem start-->
                    <div class="row">
                        <div class="col-lg-4 offset-lg-4">
                            <label for="categorySort" class="py-1">Sorting By Category</label>
                            <select name="category_id" id="categorySort" class="form-select">
                                <option value="allCategory" selected>All Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                     <!--Nayem nd-->

                    <p class="text-muted font-14">{{ Session::get('success') }}</p>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped bordered dt-responsive nowrap w-100 ">
                            <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Name</th>
                                    <th>Product Code </th>
                                    <th>Product Category </th>
                                    <th>Product Image </th>
                                    <th>Stock Amount </th>
                                    <th>Status </th>
                                    @if (auth()->user()->can('products.edit') || auth()->user()->can('products.destroy'))
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="productTableBody">
                                @if ($products->count() > 0)
                                    @foreach ($products as $index => $product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->code }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td><img src="{{ asset($product->image) }}" style="width: 50px; height:50px;">
                                            </td>
                                            <td
                                                class="{{ $product->stock_amount == 0 ? 'text-danger' : ($product->stock_amount < 10 ? 'text-warning' : '') }}">
                                                {{ $product->stock_amount }}</td>
                                            <td>
                                                @if ($product->status == 1)
                                                    <span class="badge p-1 bg-success">Published</span>
                                                @else
                                                    <span class="badge p-1 bg-danger">Unpublished</span>
                                                @endif
                                            </td>
                                            @if (auth()->user()->can('products.edit') ||
                                                    auth()->user()->can('products.show') ||
                                                    auth()->user()->can('products.destroy'))
                                                <td>
                                                    <!--edit-->
                                                    @can('products.edit')
                                                        <a href="{{ route('products.edit', $product->id) }}"
                                                            class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Product Edit">
                                                            <i class="ri-edit-box-fill"></i>
                                                        </a>
                                                        @if ($product->status == 1)
                                                            <a href="{{ route('products.status', $product->id) }}"
                                                                class="btn btn-warning btn-sm" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Published">
                                                                <i class="fa-solid fa-lock-open py-"></i>
                                                            </a>
                                                        @endif
                                                        @if ($product->status == 0)
                                                            <a href="{{ route('products.status', $product->id) }}"
                                                                class="btn btn-info btn-sm" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Unpublished">
                                                                <i class="fa-solid fa-lock"></i>
                                                            </a>
                                                        @endif
                                                    @endcan

                                                    <!--show-->
                                                    @can('products.show')
                                                        <a href="{{ route('products.show', $product->id) }}"
                                                            class="btn btn-primary btn-sm" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Product Show">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </a>
                                                    @endcan
                                                    <!--destroy-->
                                                    {{-- @can('products.destroy')
                                                        <form action="{{ route('products.destroy', $product->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Product Delete"
                                                                onclick="return confirm('Are you sure you want to delete this teacher?');">
                                                                <i class="ri-chat-delete-fill"></i>
                                                            </button>
                                                        </form>
                                                    @endcan --}}

                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">Products not found </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>

    <!--Nayem Start--->
    <script>
        $(document).ready(function() {
            // Initialize tooltips on page load
            $('[data-bs-toggle="tooltip"]').tooltip();

            $('#categorySort').change(function() {
                let categoryId = $(this).val();

                $.ajax({
                    url: '{{ route('products.sortByCategory') }}',
                    method: 'GET',
                    data: {
                        category_id: categoryId
                    },
                    beforeSend: function() {
                        $('#productTableBody').html(
                            '<tr><td colspan="8" class="text-center">Loading...</td></tr>');
                    },
                    success: function(response) {
                        let tableRows = '';

                        if (response.products.length > 0) {
                            response.products.forEach((product, index) => {
                                tableRows += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${product.name}</td>
                                        <td>${product.code}</td>
                                        <td>${product.category.name}</td>
                                        <td><img src="${product.image}" style="width: 50px; height:50px;"></td>
                                        <td class="${product.stock_amount == 0 ? 'text-danger' : (product.stock_amount < 10 ? 'text-warning' : '')}">
                                            ${product.stock_amount}
                                        </td>
                                        <td>
                                            <span class="badge p-1 bg-${product.status == 1 ? 'success' : 'danger'}">
                                                ${product.status == 1 ? 'Published' : 'Unpublished'}
                                            </span>
                                        </td>
                                        <td>
                                            <!-- Actions -->
                                            <a href="/products/${product.id}/edit" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Product Edit">
                                                <i class="ri-edit-box-fill"></i>
                                            </a>
                                            ${product.status == 1
                                                ? `<a href="/products/status/${product.id}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Published">
                                                       <i class="fa-solid fa-lock-open"></i>
                                                   </a>`
                                                : `<a href="/products/status/${product.id}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Unpublished">
                                                       <i class="fa-solid fa-lock"></i>
                                                   </a>`}
                                            <a href="/products/${product.id}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" title="View Product">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <form action="/products/${product.id}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Delete Product" onclick="return confirm('Are you sure?');">
                                                    <i class="ri-chat-delete-fill"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                `;
                            });
                        } else {
                            tableRows =
                                '<tr><td colspan="8" class="text-center">Products not found</td></tr>';
                        }

                        $('#productTableBody').html(tableRows);

                        // Reinitialize tooltips for dynamically added elements
                        $('[data-bs-toggle="tooltip"]').tooltip();
                    },
                    error: function() {
                        alert('Something went wrong while fetching data.');
                    }
                });
            });
        });
    </script>
    <!--Nayem End--->
@endsection
