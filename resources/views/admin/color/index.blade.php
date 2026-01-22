@extends('admin.layouts.master')
@section('title')
    Color Manage
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Color Module</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Color Manage</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Color Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @can('colors.create')
                <!--create-->
                <div class="my-1">
                    <a href="{{ route('colors.create') }}">
                        <button class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Color Create"><i
                                class="fa-solid fa-square-plus"></i> Add </button>
                    </a>
                </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Size Information</h4>
                    <p class="text-muted font-14">{{ Session::get('success') }}</p>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Category Name </th>
                                    <th>Color Name </th>
                                    <th>Color Code </th>
                                    {{-- <th>Description </th> --}}
                                    <th>Status </th>
                                    @if (auth()->user()->can('colors.edit') || auth()->user()->can('colors.destroy'))
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($colors->count() > 0)
                                    @foreach ($colors as $index => $color)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $color->category->name }}</td>
                                            <td>{{ $color->name }}</td>
                                            <td>
                                                <span class="badge p-1 " style="background-color: {{ $color->code }}">
                                                    {{ $color->code }}</span>
                                            </td>
                                            {{-- <td>{!! substr($color->description, 0, 65) !!}</td> --}}
                                            <td>
                                                @if ($color->status == 1)
                                                    <span class="badge p-1 bg-success">Published</span>
                                                @else
                                                    <span class="badge p-1 bg-danger">Unpublished</span>
                                                @endif
                                            </td>
                                            @if (auth()->user()->can('colors.edit') || auth()->user()->can('colors.destroy'))
                                                <td>
                                                    <!--edit-->
                                                    @can('colors.edit')
                                                        <a href="{{ route('colors.edit', $color->id) }}"
                                                            class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Color Edit">
                                                            <i class="ri-edit-box-fill"></i>
                                                        </a>
                                                        <!--status-->
                                                        @if ($color->status == 1)
                                                            <a href="{{ route('colors.show', $color->id) }}"
                                                                class="btn btn-warning btn-sm" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Unpublished">
                                                                <i class="fa-solid fa-lock-open py-"></i>
                                                            </a>
                                                        @endif
                                                        @if ($color->status == 0)
                                                            <a href="{{ route('colors.show', $color->id) }}"
                                                                class="btn btn-info btn-sm" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Published">
                                                                <i class="fa-solid fa-lock"></i>
                                                            </a>
                                                        @endif
                                                    @endcan
                                                    <!--destroy-->
                                                    {{-- @can('colors.destroy')
                                                        <form action="{{ route('colors.destroy', $color->id) }}" method="POST"
                                                            style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Color Delete"
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
                                        <td colspan="6" class="text-center">Color not found</td>
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
