@extends('admin.layouts.master')
@section('title')
    Color Edit
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('colors.index') }}">Color Manage</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Color Edit</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Color Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Color form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('colors.update', $color->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <!--Nayem Start-->
                        <div class="row mb-3">
                            <label for="category_id" class="col-md-3 col-form-label">Select Category Name</label>
                            <div class="col-md-9">
                                <select name="category_id" class="form-select select2" id="category_id">
                                    <option disabled>Select a Category</option>
                                    @if ($categories->count())
                                        @foreach ($categories as $category)
                                            <option
                                                value="{{ $category->id }}"{{ $category->id == $color->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    @else
                                        <option disabled class="text-danger">Opps! Category Not found! </option>
                                    @endif
                                </select>
                                <div class="text-danger">
                                    @error('category_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--Nayem End-->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Color Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{ $color->name }}"
                                    value="{{ old('name') }}" name="name" id="name" placeholder="Color Name" />
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="code" class="col-md-3 col-form-label">Color Code</label>
                            <div class="col-md-9">
                                <input type="color" class="form-control" value="{{ $color->code }}"
                                    value="{{ old('code') }}" name="code" id="code" />
                                <div class="text-danger">
                                    @error('code')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label">Color Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" cols="3" rows="3" placeholder="Color  Description"
                                    id="description" value={{ old('description') }}>{!! $color->description !!}</textarea>
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
                                    <input class="form-check-input" type="radio" value="1" name="status"
                                        {{ $color->status == 1 ? 'checked' : '' }} id="status1">
                                    <label class="form-check-label" for="status1">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0"
                                        {{ $color->status == 0 ? 'checked' : '' }} name="status" id="status2">
                                    <label class="form-check-label" for="status2">
                                        Unpublished
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Update Color</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>


@endsection
