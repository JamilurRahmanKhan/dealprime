@extends('admin.layouts.master')
@section('title')
    Sub Sub-categories Create
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Sub Sub-Category Module</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Sub Sub-Category</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Sub Sub-Category Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('sub_subcategories.create')
            <div class="my-1">
                <a href="{{ route('sub_subcategories.create') }}">
                    <button class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Sub SubCategory Create"><i class="fa-solid fa-square-plus"></i> Add </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Sub-SubCategory Information</h4>
                    <p class="text-muted font-14">{{ Session::get('success') }}</p>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Image </th>
                                    <th>Category </th>
                                    <th>Subcategory </th>
                                    <th>Sub-sub-category </th>
                                    <th>Status </th>
                                    @if(auth()->user()->can('sub_subcategories.edit') || auth()->user()->can('sub_subcategories.destroy') )
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($subSubcategories->count() > 0)
                                    @foreach ($subSubcategories as $index => $subSubcategory)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if ($subSubcategory->image)
                                                <img src="{{ asset($subSubcategory->image) }}" style="width: 50px; height:50px;">
                                                @else
                                                <img src="{{asset('admin')}}/assets/not-found/notfound.jpeg" alt="NO image" style="width: 50px; height:50px">
                                                @endif
                                                </td>
                                            <td>{{ $subSubcategory->category->name }}</td>
                                            <td>{{ $subSubcategory->subCategory->name }}</td>
                                            <td>{{ $subSubcategory->name }}</td>
                                            <td>
                                                @if ($subSubcategory->status==1)
                                                <span class="badge p-1 bg-success">Published</span>
                                                @else
                                                <span class="badge p-1 bg-danger">Unpublished</span>
                                                @endif
                                            </td>
                                            @if(auth()->user()->can('sub_subcategories.edit') || auth()->user()->can('sub_subcategories.destroy') )
                                            <td>
                                                <!--edit-->
                                                @can('sub_subcategories.edit')
                                                <a href="{{ route('sub_subcategories.edit', $subSubcategory->id) }}"
                                                    class="btn btn-success btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Sub Subcategory Edit">
                                                    <i class="ri-edit-box-fill"></i>
                                                </a>
                                                <!--status-->
                                                @if ($subSubcategory->status == 1)
                                                    <a href="{{ route('sub_subcategories.show', $subSubcategory->id) }}"
                                                        class="btn btn-warning btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                                        <i class="fa-solid fa-lock-open py-"></i>
                                                    </a>
                                                @endif
                                                @if ($subSubcategory->status == 0)
                                                    <a href="{{ route('sub_subcategories.show', $subSubcategory->id) }}"
                                                        class="btn btn-info btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                                        <i class="fa-solid fa-lock"></i>
                                                    </a>
                                                @endif
                                                @endcan
                                                {{-- @can('sub_subcategories.destroy')
                                                <!--destroy-->
                                                <form action="{{ route('sub_subcategories.destroy', $subSubcategory->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Sub Subcategory Delete"
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
                                        <td colspan="7" class="text-center">Sub-sub-category not found ! </td>
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
