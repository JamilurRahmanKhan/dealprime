@extends('admin.layouts.master')
@section('title')
    Categories Manage
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Category Module </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cagetory Manage</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Category Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('categories.create')
            <div class="my-1">
                <a href="{{ route('categories.create') }}">
                    <button class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Category Create"><i class="fa-solid fa-square-plus"></i> Add </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Categories Information</h4>
                    <p class="text-muted font-14">{{ Session::get('success') }}</p>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table  dt-responsive  w-100">
                            <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Category Image </th>
                                    <th>Category </th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    @if(auth()->user()->can('categories.edit') || auth()->user()->can('categories.destroy') )
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($categories->count() > 0)
                                    @foreach ($categories as $index => $category)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><img src="{{ asset($category->image) }}" style="width: 50px ; height:50px"></td>
                                            <td>{{ $category->name }}</td>
                                            <td>{!! substr($category->description, 0, 50) !!}</td>
                                            <td>
                                                @if($category->status == 1)
                                                    <span class="badge p-1 bg-success">Published</span>
                                                @else
                                                    <span class="badge p-1 bg-danger">Unpublished</span>
                                                @endif
                                            </td>

                                            @if(auth()->user()->can('categories.edit') || auth()->user()->can('categories.destroy') )
                                            <td>
                                                <!--edit-->
                                                @can('categories.edit')
                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                    class="btn btn-success btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Category Edit">
                                                    <i class="ri-edit-box-fill"></i>
                                                </a>
                                               <!--status-->
                                                @if ($category->status == 1)
                                                    <a href="{{ route('categories.show', $category->id) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Published"
                                                        class="btn btn-warning btn-sm" >
                                                        <i class="fa-solid fa-lock-open py-"></i>
                                                    </a>
                                                @endif
                                                @if ($category->status == 0)
                                                    <a href="{{ route('categories.show', $category->id) }}"
                                                        class="btn btn-info btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                                        <i class="fa-solid fa-lock"></i>
                                                    </a>
                                                @endif
                                                @endcan

                                                    <!--destory-->
                                                    {{-- @can('categories.destroy')
                                                    <form action="{{ route('categories.destroy', $category->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Category Delete"
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
                                        <td colspan="6" class="text-center">Category not found </td>
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
