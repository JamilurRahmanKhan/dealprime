@extends('admin.layouts.master')
@section('title')Sub-category Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Sub Category Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Manage Sub Category</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Sub Category Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            @can('sub_categories.create')
            <!--create-->
            <div class="my-1">
                <a  href="{{route('sub_categories.create')}}">
                    <button class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Sub Cateogry Create"><i class="fa-solid fa-square-plus"></i> Add </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Sub-Categories Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Image</th>
                            <th>category</th>
                            <th>Sub Category </th>
                            <th>Status</th>
                            @if(auth()->user()->can('sub_categories.edit') || auth()->user()->can('sub_categories.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($subcategories->count()>0)
                            @foreach($subcategories as $index=>$subCategory)
                                <tr>
                                    <td style="width: 5px; ">{{$index +1}}</td>
                                    <td>
                                        @if ($subCategory->image)
                                        <img src="{{asset($subCategory->image)}}" style="width: 50px; height:50px">
                                        @else
                                        <img src="{{asset('admin')}}/assets/not-found/notfound.jpeg" alt="NO image" style="width: 50px; height:50px">
                                        @endif
                                    </td>
                                    <td>{{$subCategory->category->name}}</td>
                                    <td>{{$subCategory->name}}</td>
                                    {{-- <td>{!! substr($subCategory->description,0,50)!!}</td> --}}
                                    <td>
                                        @if ($subCategory->status==1)
                                        <span class="badge p-1 bg-success">Published</span>
                                        @else
                                        <span class="badge p-1 bg-danger">Unpublished</span>
                                        @endif
                                    </td>
                                    @if(auth()->user()->can('sub_categories.edit') || auth()->user()->can('sub_categories.destroy') )
                                    <td>
                                        @can('sub_categories.edit')
                                        <!--edit-->
                                        <a href="{{route('sub_categories.edit',$subCategory->id)}}"
                                             class="btn btn-success btn-sm"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Sub Category Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>
                                        <!--status-->
                                        @if ($subCategory->status==1)
                                        <a href="{{route('sub_categories.show',$subCategory->id)}}"
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                            <i class="fa-solid fa-lock-open py-"></i>
                                        </a>
                                        @endif
                                        @if ($subCategory->status==0)
                                        <a href="{{route('sub_categories.show',$subCategory->id)}}"
                                             class="btn btn-info btn-sm"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                        @endif
                                        @endcan

                                        {{-- @can('sub_categories.destroy')
                                        <form action="{{route('sub_categories.destroy',$subCategory->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                             onclick="return confirm('Are you sure you want to delete this teacher?');"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Sub Category Delete">
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
                                <td colspan="6" class="text-center">Sub Category not found </td>
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
