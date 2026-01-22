@extends('admin.layouts.master')
@section('title')Courier District Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Courier District Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Courier District Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Courier District Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('district.create')
            <div class="my-1">
                <a  href="{{route('district.create')}}">
                    <button class="btn btn-info"
                     data-bs-toggle="tooltip" data-bs-placement="top" title="District Create">
                     <i class="fa-solid fa-square-plus"></i> Add
                    </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Courier District Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            {{-- <th>Division Name </th> --}}
                            <th>District Name </th>
                            <th>Status </th>
                            @if(auth()->user()->can('district.edit') || auth()->user()->can('district.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($districts->count()>0)
                            @foreach($districts as $index=>$district)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    {{-- <td>{{$district->division->name}}</td> --}}
                                    <td>{{$district->name}}</td>
                                    <td>{{$district->status==1?'Published':'Unpublished'}}</td>

                                    @if(auth()->user()->can('district.edit') || auth()->user()->can('district.destroy') )
                                    <td>
                                        <!--edit-->
                                        @can('district.edit')
                                        <a href="{{route('district.edit',$district->id)}}"
                                             class="btn btn-success btn-sm"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="District Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>
                                        <!--status-->
                                        @if ($district->status==1)
                                        <a href="{{route('district.show',$district->id)}}"
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                            <i class="fa-solid fa-lock-open py-"></i>
                                        </a>
                                        @endif
                                        @if ($district->status==0)
                                        <a href="{{route('district.show',$district->id)}}"
                                            class="btn btn-info btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                        @endif
                                        @endcan

                                        <!--Destroy-->
                                        {{-- @can('district.destroy')
                                        <form action="{{route('district.destroy',$district->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                            class="btn btn-danger btn-sm"
                                              data-bs-toggle="tooltip" data-bs-placement="top" title="District Delete"
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
                                <td colspan="7" class="text-center">Courier District info not found </td>
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
