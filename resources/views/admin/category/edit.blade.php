@extends('admin.layouts.master')
@section('title')Categories Edit @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Category Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Cagetory Edit</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Category Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Categories Form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" id="categoryEditForm" action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label">Category Image</label>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="imageInput" name="image">
                                    <small class="text-danger" id="imageError"></small>
                                    <div class="text-danger">@error('image'){{ $message }} @enderror</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <!-- Ensure the correct path is being set -->
                                    <img id="imagePreview" src="{{ asset($category->image) }}" alt="Your Image" class="img-fluid" style="display: {{ $category->image ? 'block' : 'none' }};"/>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Category Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $category->name }}" placeholder="Category Name"/>
                                <!-- Client-side error message -->
                                <div class="invalid-feedback" id="nameError"></div>
                                <!-- Server-side error message -->
                                @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label">Category Description</label>
                            <div class="col-md-9">
                            <textarea class="form-control" name="description" id="description" cols="3" rows="3" placeholder="Category Description">{!!$category->description!!}</textarea>
                            <div class="text-danger">@error('description'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$category->status== 1?'checked':''}} type="radio" value="1" name="status"
                                        id="status1">
                                    <label class="form-check-label" for="status1">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" {{$category->status== 0?'checked':''}}  value="0" name="status" id="status2">
                                    <label class="form-check-label" for="status2">
                                        Unpublished
                                    </label>
                            </div>
                        </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">
                                    <i class="fa-solid fa-check"></i> Update Category
                                </button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>
    {{-- <script>
        $(document).ready(function() {
            $('#name').on('input blur', function() {
                validateName();
            });

            $('#categoryEditForm').on('submit', function(e) {
                if (!validateName()) {
                    e.preventDefault(); // Prevent form submission if validation fails
                }
            });
            function validateName() {
                let name = $('#name').val();
                let errorElement = $('#nameError');
                let isValid = true;

                if (name.length === 0) {
                    errorElement.text('Category Name is required.');
                    $('#name').addClass('is-invalid');
                    isValid = false;
                } else if (name.length < 2) {
                    errorElement.text('Category Name must be at least 2 characters.');
                    $('#name').addClass('is-invalid');
                    isValid = false;
                } else {
                    errorElement.text('');
                    $('#name').removeClass('is-invalid');
                }

                return isValid;
            }
        });
    </script> --}}

    <script>
        $(document).ready(function () {
            // Validate Name field
            $('#name').on('input blur', function () {
                validateName();
            });

            // Validate Image field
            $('#imageInput').on('change blur', function () {
                validateImage();
            });

            // Form submission validation
            $('#categoryForm').on('submit', function (e) {
                if (!validateName() || !validateImage()) {
                    e.preventDefault(); // Prevent form submission if validation fails
                }
            });

            // Validate Name field
            function validateName() {
                let name = $('#name').val();
                let errorElement = $('#nameError');
                let isValid = true;

                if (name.length === 0) {
                    errorElement.text('Category Name is required.');
                    $('#name').addClass('is-invalid');
                    isValid = false;
                } else if (name.length < 2) {
                    errorElement.text('Category Name must be at least 2 characters.');
                    $('#name').addClass('is-invalid');
                    isValid = false;
                } else {
                    errorElement.text('');
                    $('#name').removeClass('is-invalid');
                }

                return isValid;
            }

            // Validate Image field
            function validateImage() {
                let fileInput = $('#imageInput').val();
                let errorElement = $('#imageError');
                let isValid = true;

                // Reset error messages
                errorElement.text('');
                $('#imageInput').removeClass('is-invalid');

                if (fileInput === '') {
                    errorElement.text('Category Image is required.');
                    $('#imageInput').addClass('is-invalid');
                    isValid = false;
                } else {
                    let file = $('#imageInput')[0].files[0];

                    // Validate file size (2MB = 2 * 1024 * 1024 bytes)
                    if (file.size > 2 * 1024 * 1024) {
                        errorElement.text('File size must not exceed 2MB.');
                        $('#imageInput').addClass('is-invalid');
                        isValid = false;
                    }

                    // Validate image resolution
                    let img = new Image();
                    img.onload = function () {
                        if (this.width > 1920 || this.height > 1080) {
                            errorElement.text('Image dimensions should not exceed 1920x1080 pixels.');
                            $('#imageInput').addClass('is-invalid');
                            isValid = false;
                        }
                    };
                    img.onerror = function () {
                        errorElement.text('Invalid image file.');
                        $('#imageInput').addClass('is-invalid');
                        isValid = false;
                    };
                    img.src = URL.createObjectURL(file);
                }

                return isValid;
            }
        });
    </script>
@endsection
