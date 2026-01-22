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
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Add Sub Sub-Categories form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('sub_subcategories.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Image -->
                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label"> Sub Sub-Category Image</label>
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
                                <div class="form-group">
                                    <img id="imagePreview" src="#" alt="Your Image" class="img-fluid" />
                                </div>
                            </div>
                        </div>
                        <!-- Category -->
                        <div class="row mb-3">
                            <label for="category" class="col-md-3 col-form-label">Category Name</label>
                            <div class="col-md-9">
                                <div class="dropdown searchable-dropdown">
                                    <input type="text" id="search-input-category" class="form-control"
                                        placeholder="Select Category" data-toggle="dropdown" readonly>
                                    <div class="dropdown-menu" aria-labelledby="search-input-category">
                                        <input type="text" id="option-search-input-category" class="form-control"
                                            placeholder="Search...">
                                        @foreach ($categories as $category)
                                            <a class="dropdown-item category-item"
                                                data-id="{{ $category->id }}">{{ $category->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="text-danger">
                                    @error('category_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="category_id" id="category-id">
                        </div>

                        <!-- Sub Category -->
                        <div class="row mb-3">
                            <label for="sub_category" class="col-md-3 col-form-label">Sub Category Name</label>
                            <div class="col-md-9">
                                <div class="dropdown searchable-dropdown">
                                    <input type="text" id="search-input-sub_category" class="form-control"
                                        placeholder="Select Sub Category" data-toggle="dropdown" readonly>
                                    <div class="dropdown-menu" aria-labelledby="search-input-sub_category">
                                        <input type="text" id="option-search-input-sub_category" class="form-control"
                                            placeholder="Search...">
                                        <div id="subcategory-list">
                                            <!-- Subcategories will be dynamically added here -->
                                        </div>
                                    </div>
                                </div>
                                <div class="text-danger">
                                    @error('sub_category_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="sub_category_id" id="sub-category-id">
                        </div>

                        <!-- Sub-sub-category Name -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Sub Sub-Category Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name') }}" placeholder="Sub Sub-Category Name" />
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label">Sub Sub-Category Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" id="description" cols="3" rows="3"
                                    placeholder="Sub Sub-Category Description"></textarea>
                                <div class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- status -->
                        <div class="row mb-3">
                            <label for="status" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" name="status" checked
                                        id="status1">
                                    <label class="form-check-label" for="status1">Published</label>
                                </div>
                                &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0" name="status"
                                        id="status2">
                                    <label class="form-check-label" for="status2">Unpublished</label>
                                </div>
                            </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9 mt-2">
                                <button type="submit" class="btn btn-info">Add Sub Sub Category</button>
                            </div>
                        </div>
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>


    <script>
        //------------------------Dependent category and subcateogry create page jquery ajax code ----------------------------

        $(document).ready(function() {
            // Category selection
            $('.category-item').on('click', function() {
                var categoryId = $(this).data('id');
                var categoryName = $(this).text();

                $('#search-input-category').val(categoryName);
                $('#category-id').val(categoryId);

                // Hide the dropdown
                $('.dropdown-menu').removeClass('show');

                // Clear the subcategory input and hidden field
                $('#search-input-sub_category').val('');
                $('#sub-category-id').val('');
                $('#subcategory-list').empty();

                // Load subcategories
                loadSubCategories(categoryId);
            });

            // Subcategory search
            $('#option-search-input-sub_category').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#subcategory-list .dropdown-item').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        function loadSubCategories(categoryId) {
            $.ajax({
                url: '/get-subcategories/' + categoryId, // Modified endpoint to include category ID
                type: 'GET',
                success: function(response) {
                    $('#subcategory-list').empty();
                    response.subcategories.forEach(function(subcategory) {
                        $('#subcategory-list').append(
                            '<a class="dropdown-item subcategory-item" data-id="' + subcategory.id +
                            '">' + subcategory.name + '</a>');
                    });

                    // Subcategory selection
                    $('.subcategory-item').on('click', function() {
                        var subCategoryId = $(this).data('id');
                        var subCategoryName = $(this).text();

                        $('#search-input-sub_category').val(subCategoryName);
                        $('#sub-category-id').val(subCategoryId);

                        // Hide the dropdown
                        $('.dropdown-menu').hide();
                        // $('.dropdown-menu').removeClass('hide');
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
