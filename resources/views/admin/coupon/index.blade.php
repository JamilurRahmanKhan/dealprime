@extends('admin.layouts.master')
@section('title')Discount Coupon Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Discount Coupon Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Discount Coupon Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Discount Coupon Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('coupon.create')
            <div class="my-1">
                <a  href="{{route('coupon.create')}}">
                    <button class="btn btn-info"
                     data-bs-toggle="tooltip" data-bs-placement="top" title="Coupon Create">
                        <i class="fa-solid fa-square-plus"></i> Add
                    </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Discount Coupon Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive  w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Coupon Name </th>
                            <th>Code </th>
                            <th>Coupon Type </th>
                            <th>Coupon TK/Percentage </th>
                            <th>Cart Amount </th>
                            <th>Starting Time </th>
                            <th>Ending Time </th>
                            <th>Status </th>
                            @if(auth()->user()->can('coupon.edit') || auth()->user()->can('coupon.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($coupons->count()>0)
                            @foreach($coupons as $index=>$coupon)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$coupon->name}}</td>
                                    <td>{{$coupon->code}}</td>
                                    <td>{{$coupon->coupon_type}}</td>
                                    <td>{{$coupon->coupon_amount}} {{$coupon->coupon_type=='fixed'?'Tk':'%'}}</td>
                                    <td>{{$coupon->cart_amount}}</td>
                                    {{-- h:i A --}}
                                    <td>{{ \Carbon\Carbon::parse($coupon->start_day)->format('F j, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($coupon->end_day)->format('F j, Y ') }}</td>
                                    <td>{{$coupon->status==1?'Published':'Unpublished'}}</td>
                                    @if(auth()->user()->can('coupon.edit') || auth()->user()->can('coupon.destroy') )
                                    <td>
                                        <!--edit-->
                                        @can('coupon.edit')
                                        <a href="{{route('coupon.edit',$coupon->id)}}"
                                            class="btn btn-success btn-sm mb-1"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Coupon Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>
                                        <!--status-->
                                        @if ($coupon->status==1)
                                        <a href="{{route('coupon.show',$coupon->id)}}"
                                            class="btn btn-warning btn-sm mb-1"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                            <i class="fa-solid fa-lock-open py-"></i>
                                        </a>
                                        @endif
                                        @if ($coupon->status==0)
                                        <a href="{{route('coupon.show',$coupon->id)}}"
                                             class="btn btn-info btn-sm mb-1"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                        @endif
                                        @endcan
                                        <!--Destroy-->
                                        {{-- @can('coupon.destroy')
                                        <form action="{{route('coupon.destroy',$coupon->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                             onclick="return confirm('Are you sure you want to delete this teacher?');"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Coupon Delete">
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
                                <td colspan="10" class="text-center">Discount Coupon info not found </td>
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
