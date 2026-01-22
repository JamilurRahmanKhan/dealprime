@extends('admin.layouts.master')
@section('title')
    Features Manage
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Feature Module </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Features Manage</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Feature Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="my-1">
                <a href="{{ route('features.create') }}">
                    <button class="btn btn-info"><i class="fa-solid fa-square-plus"></i> Add </button>
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Features Information</h4>
                    <p class="text-muted font-14">{{ Session::get('success') }}</p>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Features Image </th>
                                    <th>Features Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($features->count() > 0)
                                    @foreach ($features as $index => $feature)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td><img src="{{ asset($feature->image) }}" style="width: 50px"></td>
                                            <td>{{ $feature->name }}</td>
                                            <td>{{$feature->status==1?'Published':'Unpublished'}}</td>
                                            <td>
                                                <a href="{{ route('features.edit', $feature->id) }}"
                                                    class="btn btn-success btn-sm" title="Edit">
                                                    <i class="ri-edit-box-fill"></i>
                                                </a>

                                                <form action="{{ route('features.destroy', $feature->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this teacher?');">
                                                        <i class="ri-chat-delete-fill"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Features not found </td>
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
