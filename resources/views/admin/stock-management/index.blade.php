@extends('admin.layouts.master')
@section('title')Stock Management Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Stock Management Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Stock Management Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Stock Management Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Stock  Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table  dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            @if (Auth::user()->role=='Admin')
                            <th>Merchant name </th>
                            <th>Shop Name </th>
                            @endif
                            <th>Product Name & Code </th>
                            <th>Stock Amount </th>
                        </tr>
                        </thead>
                        <tbody>
                            @if ($products->count()>0)
                            @foreach($products as $index=>$product)
                                <tr class="{{ $product->stock_amount == 0 ? 'bg-danger text-dark' : ($product->stock_amount < 10 ? 'bg-warning' : '') }}">
                                    <td>{{$index +1}}</td>
                                    @if (Auth::user()->role=='Admin')
                                    <td>{{ $product->user?->name }}</td>
                                    <td>{{$product->user?->shop_name}}</td>
                                    @endif
                                    <td>{{$product->name}} - {{$product->code}}</td>
                                    <td>
                                        <form action="{{route('stock.update',$product->id)}}" method="post" class="d-inline form-inline align-items-center">
                                            @csrf
                                            <div class="form-group mb-0 d-flex align-items-center">
                                                <input type="number" name="stock_amount" value="{{ $product->stock_amount }}"
                                                       style="width: 170px;"
                                                       class="form-control" placeholder="Stock Amount">
                                                <button type="submit" class="btn btn-info">Update</button> <br>
                                            </div>
                                            <div class="text-danger" style="margin-right: 10px;">
                                                @error('stock_amount') {{ $message }} @enderror
                                            </div>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6" class="text-center">Stock  not found </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>
@endsection
