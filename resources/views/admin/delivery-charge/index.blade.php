@extends('admin.layouts.master')
@section('title')Delivery Charge Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Delivery Charge Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Delivery Charge Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Delivery Charge Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('delivery_charge.create')
            <div class="my-1">
                <a  href="{{route('delivery_charge.create')}}">
                    <button class="btn btn-info"   data-bs-toggle="tooltip" data-bs-placement="top" title="Delivery Charge Create"><i class="fa-solid fa-square-plus"></i> Add </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Delivery Charge Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive  w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Location Name </th>
                            <th>Delivery charge </th>
                            <th>Status </th>
                            @if(auth()->user()->can('delivery_charge.edit') || auth()->user()->can('delivery_charge.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($deliveryCharges->count()>0)
                            @foreach($deliveryCharges as $index=>$charge)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$charge->location_name}}</td>
                                    <td>{{$charge->delivery_charge}} tk</td>
                                    <td>
                                        @if ($charge->status==1)
                                        <span class="badge p-1 bg-success">Published</span>
                                        @else
                                        <span class="badge p-1 bg-danger">Unpublished</span>
                                        @endif
                                    </td>

                                    @if(auth()->user()->can('delivery_charge.edit') || auth()->user()->can('delivery_charge.destroy') )
                                    <td>
                                        <!--edit-->
                                        @can('delivery_charge.edit')
                                        <a href="{{route('delivery_charge.edit',$charge->id)}}"
                                             class="btn btn-success btn-sm"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Delivery Charge Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>

                                        @if ($charge->status==1)
                                        <a href="{{route('delivery_charge.show',$charge->id)}}"
                                             class="btn btn-warning btn-sm"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                            <i class="fa-solid fa-lock-open py-"></i>
                                        </a>
                                        @endif
                                        @if ($charge->status==0)
                                        <a href="{{route('delivery_charge.show',$charge->id)}}"
                                            class="btn btn-info btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                        @endif
                                        @endcan
                                        <!--Destroy-->
                                        {{-- @can('delivery_charge.destroy')
                                        <form action="{{route('delivery_charge.destroy',$charge->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Delivery Charge Delete"
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
                                <td colspan="6" class="text-center">Delivery Charge not found </td>
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
