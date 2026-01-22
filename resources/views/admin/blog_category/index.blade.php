@extends('admin.layouts.master')
@section('title')
   Blog Categories Manage
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Blog Category Module </a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Blog Cagetory Manage</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Blog Category Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @can('blog_categories.create')
            <div class="my-1">
                <a href="{{ route('blog_categories.create') }}">
                    <button class="btn btn-info"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Blog Category Create ">
                        <i class="fa-solid fa-square-plus"></i> Add
                    </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Blog Categories Information</h4>
                    <p class="text-muted font-14">{{ Session::get('success') }}</p>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Category Image </th>
                                    <th>Category </th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    @if(auth()->user()->can('blog_categories.edit') || auth()->user()->can('blog_categories.destroy') )
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($blogCategories->count() > 0)
                                    @foreach ($blogCategories as $index => $blogCategory)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if ($blogCategory->image)
                                                <img src="{{ asset($blogCategory->image) }}" style="width: 50px ; height:50px">
                                                @else
                                                <img src="{{asset('admin')}}/assets/not-found/notfound.jpeg" style="width: 50px ; height:50px">
                                                @endif
                                            </td>
                                            <td>{{ $blogCategory->name }}</td>
                                            <td>{!! substr($blogCategory->description, 0, 50) !!}</td>
                                            <td>{{$blogCategory->status==1?'Published':'Unpublished'}}</td>

                                            @if(auth()->user()->can('blog_categories.edit') || auth()->user()->can('blog_categories.destroy') )
                                            <td>
                                                <!--edit-->
                                                @can('blog_categories.edit')
                                                <a href="{{ route('blog_categories.edit', $blogCategory->id) }}"
                                                    class="btn btn-success btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Blog Category Edit">
                                                    <i class="ri-edit-box-fill"></i>
                                                </a>
                                                <!--status-->
                                                @if ($blogCategory->status == 1)
                                                    <a href="{{ route('blog_categories.show', $blogCategory->id) }}"
                                                        class="btn btn-warning btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                                        <i class="fa-solid fa-lock-open py-"></i>
                                                    </a>
                                                @endif
                                                @if ($blogCategory->status == 0)
                                                    <a href="{{ route('blog_categories.show', $blogCategory->id) }}"
                                                        class="btn btn-info btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                                        <i class="fa-solid fa-lock"></i>
                                                    </a>
                                                @endif
                                                @endcan

                                                <!--Destroy-->
                                                {{-- @can('blog_categories.destroy')
                                                <form action="{{ route('blog_categories.destroy', $blogCategory->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                      data-bs-toggle="tooltip" data-bs-placement="top" title="Blog Category Delete"
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
                                        <td colspan="6" class="text-center">Blog category not found </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection
