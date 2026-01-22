@extends('admin.layouts.master')
@section('title')Carousel Create @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Carousel Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Carousel Add</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Carousel Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Add Carousel form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('carousels.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label">Carousel Image</label>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="imageInput" name="image">
                                    <div class="text-danger">@error('image'){{$message}} @enderror</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <img id="imagePreview" src="#" alt="Your Image" class="img-fluid"/>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Product Name</label>
                            <div class="col-md-9">
                                <select name="product_id" class="form-control">
                                    <option disabled selected>------------Select product----------</option>
                                    @foreach ($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            <div class="text-danger">@error('product_id'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-md-3 col-form-label">Carousel Title</label>
                            <div class="col-md-9">
                                <small>Note: Title should not be more than 15 word.</small>
                                <textarea name="title" class="form-control"  placeholder="Carousel title" id="title" cols="3" rows="3">{{ old('title') }}</textarea>
                                <div class="text-danger">@error('title'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="details" class="col-md-3 col-form-label">Short details</label>
                            <div class="col-md-9">
                                <small>Note: Short details should not be more than 30 word.</small>
                                <textarea name="short_details" class="form-control"  placeholder="Short Details" id="details" cols="3" rows="3">{{ old('short_details') }}</textarea>
                                <div class="text-danger">@error('short_details'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" name="status" checked
                                        id="status1">
                                    <label class="form-check-label" for="status">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0" name="status" id="status2">
                                    <label class="form-check-label" for="status">
                                        Unpublished
                                    </label>
                            </div>
                        </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9 mt-2">
                                <button type="submit" class="btn btn-info">Add carousel</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>


@endsection
