@extends('admin.layouts.master')
@section('title')Couriers Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Couriers Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Couriers Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Couriers Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('couriers.create')
            <div class="my-1">
                <a  href="{{route('couriers.create')}}">
                    <button class="btn btn-info"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Courier Create">
                        <i class="fa-solid fa-square-plus"></i> Add
                    </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Couriers Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Courier Name </th>
                            <th>Courier Email </th>
                            <th>Mobile </th>
                            <th>Address </th>
                            <th>Status </th>
                            @if(auth()->user()->can('couriers.edit') || auth()->user()->can('couriers.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($couriers->count()>0)
                            @foreach($couriers as $index=>$courier)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$courier->name}}</td>
                                    <td>{{$courier->email}}</td>
                                    <td>{{$courier->mobile}}</td>
                                    <td>{{$courier->address}}</td>
                                    <td>{{$courier->status==1?'Published':'Unpublished'}}</td>

                                    @if(auth()->user()->can('couriers.edit') || auth()->user()->can('couriers.destroy') )
                                    <td>
                                        <!--edit-->
                                        @can('couriers.edit')
                                        <a href="{{route('couriers.edit',$courier->id)}}"
                                            class="btn btn-success btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Courier Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>
                                        <!--status-->
                                        @if ($courier->status==1)
                                        <a href="{{route('couriers.show',$courier->id)}}"
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                            <i class="fa-solid fa-lock-open py-"></i>
                                        </a>
                                        @endif
                                        @if ($courier->status==0)
                                        <a href="{{route('couriers.show',$courier->id)}}"
                                            class="btn btn-info btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                        @endif
                                        @endcan
                                        <!--Destroy-->
                                        @can('couriers.destroy')
                                        <form action="{{route('couriers.destroy',$courier->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                              data-bs-toggle="tooltip" data-bs-placement="top" title="Courier Delete"
                                             onclick="return confirm('Are you sure you want to delete this teacher?');">
                                                <i class="ri-chat-delete-fill"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="text-center">Couriers info not found </td>
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
