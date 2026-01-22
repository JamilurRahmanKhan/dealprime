@extends('admin.layouts.master')
@section('title')Brand Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Brand Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Brand Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Brand Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('brands.create')
            <div class="my-1">
                <a  href="{{route('brands.create')}}">
                    <button class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Brand Create"><i class="fa-solid fa-square-plus"></i> Add </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Brand Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Brand  Image </th>
                            <th>Brand Name</th>
                            <th>Brand Description</th>
                            <th>Status</th>
                            @if(auth()->user()->can('brands.edit') || auth()->user()->can('brands.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($brands->count()>0)
                            @foreach($brands as $index=>$brand)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>
                                        @if ($brand->image)
                                        <img src="{{asset($brand->image)}}" style="width: 50px; height:50px">
                                        @else
                                        <img src="{{asset('admin')}}/assets/not-found/notfound.jpeg" alt="NO image" style="width: 50px; height:50px">
                                        @endif
                                    </td>
                                    <td>{{$brand->name}}</td>
                                    <td>{!!substr($brand->description,0,50)!!}</td>
                                    <td>
                                        @if ($brand->status==1)
                                        <span class="badge p-1 bg-success">Published</span>
                                        @else
                                        <span class="badge p-1 bg-danger">Unpublished</span>
                                        @endif
                                    </td>

                                    @if(auth()->user()->can('brands.edit') || auth()->user()->can('brands.destroy') )
                                    <td>
                                        <!--edit-->
                                        @can('brands.edit')
                                        <a href="{{route('brands.edit',$brand->id)}}"
                                            class="btn btn-success btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Brand Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>
                                        <!--status-->
                                        @if ($brand->status==1)
                                        <a href="{{route('brands.show',$brand->id)}}"
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                            <i class="fa-solid fa-lock-open py-"></i>
                                        </a>
                                        @endif
                                        @if ($brand->status==0)
                                        <a href="{{route('brands.show',$brand->id)}}"
                                             class="btn btn-info btn-sm"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                        @endif
                                        @endcan
                                        <!--destroy-->
                                        {{-- @can('brands.destroy')
                                        <form action="{{route('brands.destroy',$brand->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Brand Delete"
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
                                <td colspan="6" class="text-center">Brand not found </td>
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
