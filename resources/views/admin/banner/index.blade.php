@extends('admin.layouts.master')
@section('title')Banner Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Banner Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Banner Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Banner Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('banner.create')
            <div class="my-1">
                <a  href="{{route('banner.create')}}">
                    <button class="btn btn-info"   data-bs-toggle="tooltip" data-bs-placement="top" title="Banner Create"><i class="fa-solid fa-square-plus"></i> Add </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Banner Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Banner image </th>
                            <th>Banner title </th>
                            <th>Banner position </th>
                            <th>Status </th>
                            @if(auth()->user()->can('banner.edit') || auth()->user()->can('banner.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($banners->count()>0)
                            @foreach($banners as $index=>$banner)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>
                                        @if ($banner->image)
                                        <img src="{{asset($banner->image)}}" style="width: 50px; height:50px">
                                        @else
                                        <img src="{{asset('admin')}}/assets/not-found/notfound.jpeg" alt="NO image" style="width: 50px; height:50px">
                                        @endif
                                    </td>
                                    <td>{{$banner->image_url}}</td>
                                    <td>{{$banner->banner_position}}</td>
                                    <td>
                                        @if ($banner->status==1)
                                        <span class="badge p-1 bg-success">Published</span>
                                        @else
                                        <span class="badge p-1 bg-danger">Unpublished</span>
                                        @endif
                                    </td>


                                    @if(auth()->user()->can('banner.edit') || auth()->user()->can('banner.destroy') )
                                    <td>
                                        <!--edit-->
                                        @can('banner.edit')
                                        <a href="{{route('banner.edit',$banner->id)}}"
                                             class="btn btn-success btn-sm"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Banner Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>
                                        @endcan
                                        <!--Destroy-->
                                        {{-- @can('banner.destroy')
                                        <form action="{{route('Banner.destroy',$Banner->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Banner Delete"
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
                                <td colspan="6" class="text-center">Banner not found </td>
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
