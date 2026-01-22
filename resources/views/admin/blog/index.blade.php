@extends('admin.layouts.master')
@section('title')
    Blogs Manage
@endsection
@section('body')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Blog Module</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Manage</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Blog Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('blogs.create')
            <div class="my-1">
                <a href="{{ route('blogs.create') }}">
                    <button class="btn btn-info"
                     data-bs-toggle="tooltip" data-bs-placement="top" title="Blog Create">
                     <i class="fa-solid fa-square-plus"></i> Add
                    </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Blogs Information</h4>
                    <p class="text-muted font-14">{{ Session::get('success') }}</p>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped bordered dt-responsive nowrap w-100 ">
                            <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Blog Image </th>
                                    <th>Blog Category</th>
                                    <th>Blog Title</th>
                                    <th>Created By </th>
                                    <th>Created Time </th>
                                    <th>Status</th>
                                    @if(auth()->user()->can('blogs.edit') || auth()->user()->can('blogs.show') || auth()->user()->can('blogs.destroy') )
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($blogs->count() > 0)
                                    @foreach ($blogs as $index => $blog)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><img src="{{ asset($blog->image) }}" style="width: 50px; height:50px;"></td>
                                            <td>{{ $blog->blogCategory->name }}</td>
                                            <td>{{ Str::substr($blog->title, 1,30)}}..</td>
                                            <td>{{ $blog->created_by }}</td>
                                            <td>{{ \Carbon\Carbon::parse($blog->created_time)->format('F j, Y') }}</td>
                                            <td>{{ $blog->status == 1 ? 'Published' : 'Unpubllished' }}</td>

                                            @if(auth()->user()->can('blogs.edit') || auth()->user()->can('blogs.show') || auth()->user()->can('blogs.destroy') )
                                            <td>
                                                <!--edit-->
                                                @can('blogs.edit')
                                                <a href="{{ route('blogs.edit', $blog->id) }}"
                                                    class="btn btn-success btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Blog Edit">
                                                    <i class="ri-edit-box-fill"></i>
                                                </a>
                                                @if ($blog->status == 1)
                                                    <a href="{{ route('blog.status', $blog->id) }}"
                                                        class="btn btn-warning btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                                        <i class="fa-solid fa-lock-open py-"></i>
                                                    </a>
                                                @endif
                                                @if ($blog->status == 0)
                                                    <a href="{{ route('blog.status', $blog->id) }}"
                                                        class="btn btn-info btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                                        <i class="fa-solid fa-lock"></i>
                                                    </a>
                                                @endif
                                                @endcan

                                                <!--show-->
                                                @can('blogs.show')
                                                <a href="{{ route('blogs.show', $blog->id) }}"
                                                    class="btn btn-primary btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Blog Show">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                @endcan

                                                <!--destroy-->
                                                {{-- @can('blogs.destroy')
                                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Blog Delete"
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
                                        <td colspan="8" class="text-center">Blog not found !</td>
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
