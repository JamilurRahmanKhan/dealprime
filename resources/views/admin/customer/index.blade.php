@extends('admin.layouts.master')
@section('title')
    Customer Manage
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Customer Module</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Customer Manage</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Customer Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {{-- @can('Customers.create')
                <!--create-->
                <div class="my-1">
                    <a href="{{ route('Customers.create') }}">
                        <button class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Customer Create"><i
                                class="fa-solid fa-square-plus"></i> Add </button>
                    </a>
                </div>
            @endcan --}}
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Customer Information</h4>
                    <p class="text-muted font-14">{{ Session::get('success') }}</p>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Customer Name </th>
                                    <th>Customer Email </th>
                                    <th>Customer Phone </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($customers->count() > 0)
                                    @foreach ($customers as $index => $customer)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>
                                                <form action="{{route('customers.destroy',$customer->id)}}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Customer Delete"
                                                     onclick="return confirm('Are you sure you want to delete this customer?');">
                                                        <i class="fa fa-trash" style="color: red"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Customer not found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection
