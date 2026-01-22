@extends('admin.layouts.master')
@section('title')Sub-categories Create @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Sub Category Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Add Sub Category</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Sub Category Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Add Sub-Categories form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('sub_categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label"> Sub Category Image</label>
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
                            <label for="name" class="col-md-3 col-form-label">Category Name</label>
                            <div class="col-md-9">
                                <div class="dropdown searchable-dropdown">
                                    <input type="text" id="search-input-category" name=""
                                        class="form-control" placeholder="Select Category" data-toggle="dropdown"
                                        readonly>
                                    <div class="dropdown-menu" aria-labelledby="search-input-category">
                                        <input type="text" id="option-search-input-category" class="form-control  @error('category_id') is-invalid @enderror"
                                            placeholder="Search...">
                                        @foreach ($categories as $category)
                                            <a class="dropdown-item" href="#" data-id="{{ $category->id }}">{{ $category->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <input type="hidden" id="category-id" name="category_id">
                                <div class="text-danger">@error('category_id'){{$message}} @enderror</div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label"> Sub Category Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror " name="name" id="name" value="{{old('name')}}" placeholder="Sub Category Name"/>
                             <!-- Client-side error message -->
                             <div class="invalid-feedback" id="nameError"></div>

                             <!-- Server-side error message -->
                             @error('name')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label">Sub Category Description</label>
                            <div class="col-md-9">
                            <textarea class="form-control" name="description" id="description" cols="3" rows="3" placeholder="Sub Category Description"></textarea>
                            <div class="text-danger">@error('description'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" name="status" checked id="status1">
                                    <label class="form-check-label" for="status1">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0" name="status" id="status2">
                                    <label class="form-check-label" for="status2">
                                        Unpublished
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9 mt-2">
                                <button type="submit" class="btn btn-info">Add sub category</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownItems = document.querySelectorAll('.dropdown-item');
            const searchInput = document.getElementById('search-input-category');
            const hiddenInput = document.getElementById('category-id');

            dropdownItems.forEach(item => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    const categoryId = this.getAttribute('data-id');
                    const categoryName = this.textContent;

                    searchInput.value = categoryName;
                    hiddenInput.value = categoryId;
                });
            });

            const optionSearchInput = document.getElementById('option-search-input-category');
            optionSearchInput.addEventListener('input', function () {
                const filter = this.value.toLowerCase();
                dropdownItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    if (text.includes(filter)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endsection
