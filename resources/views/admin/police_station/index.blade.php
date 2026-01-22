@extends('admin.layouts.master')
@section('title')Courier Police Station Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Courier Police Station Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Courier Police Station Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Courier Police Station Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('police_station.create')
            <div class="my-1">
                <a  href="{{route('police_station.create')}}">
                    <button class="btn btn-info"
                     data-bs-toggle="tooltip" data-bs-placement="top" title="Police Station Create">
                     <i class="fa-solid fa-square-plus"></i> Add
                    </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Courier Police Station Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>District Name </th>
                            <th>Police Station Name </th>
                            <th>Status </th>
                            @if(auth()->user()->can('police_station.edit') || auth()->user()->can('police_station.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($stations->count()>0)
                            @foreach($stations as $index=>$station)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$station->district->name}}</td>
                                    <td>{{$station->name}}</td>
                                    <td>{{$station->status==1?'Published':'Unpublished'}}</td>
                                    @if(auth()->user()->can('police_station.edit') || auth()->user()->can('police_station.destroy') )
                                    <td>
                                        <!--edit-->
                                        @can('police_station.edit')
                                        <a href="{{route('police_station.edit',$station->id)}}"
                                            class="btn btn-success btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Station Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>
                                        <!--status-->
                                        @if ($station->status==1)
                                        <a href="{{route('police_station.show',$station->id)}}"
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                            <i class="fa-solid fa-lock-open py-"></i>
                                        </a>
                                        @endif
                                        @if ($station->status==0)
                                        <a href="{{route('police_station.show',$station->id)}}"
                                            class="btn btn-info btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                        @endif
                                        @endcan
                                        <!--destroy-->
                                        {{-- @can('police_station.destroy')
                                        <form action="{{route('police_station.destroy',$station->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                              data-bs-toggle="tooltip" data-bs-placement="top" title="Station Delete"
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
                                <td colspan="7" class="text-center">Courier police Station info not found </td>
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
