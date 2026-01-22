@extends('admin.layouts.master')
@section('title')Units Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Unit Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Unit Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Unit Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('units.create')
            <div class="my-1">
                <a  href="{{route('units.create')}}">
                    <button class="btn btn-info"data-bs-toggle="tooltip" data-bs-placement="top" title="Unit Create" ><i class="fa-solid fa-square-plus"></i> Add </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Units Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Unit Name</th>
                            <th>Unit Code</th>
                            <th>Description</th>
                            <th>Status</th>
                            @if(auth()->user()->can('units.edit') || auth()->user()->can('units.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($units->count()>0)
                            @foreach($units as $index=>$unit)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$unit->name}}</td>
                                    <td>{{$unit->code}}</td>
                                    <td>{!!substr($unit->description,0,65)!!}</td>
                                    <td>
                                        @if ($unit->status==1)
                                        <span class="badge p-1 bg-success">Published</span>
                                        @else
                                        <span class="badge p-1 bg-danger">Unpublished</span>
                                        @endif
                                    </td>

                                    @if(auth()->user()->can('units.edit') || auth()->user()->can('units.destroy') )
                                    <td>
                                        <!--edit-->
                                        @can('units.edit')
                                        <a href="{{route('units.edit',$unit->id)}}"
                                            class="btn btn-success btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Unit Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>
                                        <!--status-->
                                        @if ($unit->status==1)
                                        <a href="{{route('units.show',$unit->id)}}"
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                            <i class="fa-solid fa-lock-open py-"></i>
                                        </a>
                                        @endif
                                        @if ($unit->status==0)
                                        <a href="{{route('units.show',$unit->id)}}"
                                            class="btn btn-info btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                        @endif
                                        @endcan

                                        <!--destroy-->
                                        {{-- @can('units.destroy')
                                        <form action="{{route('units.destroy',$unit->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Unit Delete"
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
                                <td colspan="6" class="text-center">Units not found </td>
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
