@extends('admin.layouts.master')
@section('title')
    Brand Edit
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Brand Manage</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Brand Edit</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Brand Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Brand form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('brands.update',$brand->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label">Brand Image</label>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="imageInput" name="image">
                                    <div class="text-danger">
                                        @error('image')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <img id="imagePreview" src="{{ asset($brand->image) }}" alt="Your Image"
                                        class="img-fluid" style="display:{{ $brand->image ? 'block' : 'none' }}" />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Brand Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{ $brand->name }}" name="name"
                                    value="{{ old('name') }}" id="name" placeholder="Brand  Name" />
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label">Brand Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" id="description" cols="3" rows="3"
                                    placeholder="Brand Description">{!! $brand->description !!}</textarea>
                                <div class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" name="status" {{ $brand->status == 1 ? 'checked' : '' }} id="status1">
                                    <label class="form-check-label" for="status1">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0" {{ $brand->status == 0 ? 'checked' : '' }} name="status" id="status2">
                                    <label class="form-check-label" for="status2">
                                        Unpublished
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Brand Update</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection
