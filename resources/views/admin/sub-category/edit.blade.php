@extends('admin.layouts.master')
@section('title')Sub-categories Edit @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('sub_categories.index')}}">Sub Category Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Edit Sub Category</li>
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
                    <h4 class="header-title">Edit Sub-Categories form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('sub_categories.update',$subCategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

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
                                    <img id="imagePreview" src="{{ asset($subCategory->image) }}" alt="Your Image" class="img-fluid" style="display: {{ $subCategory->image ? 'block' : 'none' }};"/>
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
                                        <input type="text" id="option-search-input-category" class="form-control"
                                            placeholder="Search...">
                                        @foreach ($categories as $category)
                                            <a class="dropdown-item" href="#"
                                               data-id="{{ $category->id }}"
                                               data-name="{{ $category->name }}">
                                               {{ $category->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <input type="hidden" id="category-id" name="category_id" value="{{ $subCategory->category_id }}">
                                <div class="text-danger">@error('category_id'){{ $message }} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label"> Sub Category Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$subCategory->name}}" name="name" id="name" value="{{old('name')}}" placeholder="Sub Category Name"/>
                            <div class="text-danger">@error('name'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label">Sub Category Description</label>
                            <div class="col-md-9">
                            <textarea class="form-control" name="description" id="description" cols="3" rows="3" placeholder="Sub Category Description">{!!$subCategory->description!!}</textarea>
                            <div class="text-danger">@error('description'){{$message}} @enderror</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" {{$subCategory->status==1?'checked':''}}  name="status" checked id="status1">
                                    <label class="form-check-label" for="status1">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0" {{$subCategory->status==0?'checked':''}}  name="status" id="status2">
                                    <label class="form-check-label" for="status2">
                                        Unpublished
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9 mt-2">
                                <button type="submit" class="btn btn-info">Update subcategory</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var searchInput = document.getElementById('search-input-category');
            var optionSearchInput = document.getElementById('option-search-input-category');
            var dropdownItems = document.querySelectorAll('.dropdown-item');
            var hiddenInput = document.getElementById('category-id');

            // Set initial value from hidden input
            var initialCategory = dropdownItems[0].innerHTML;
            for (var item of dropdownItems) {
                if (item.getAttribute('data-id') == hiddenInput.value) {
                    initialCategory = item.getAttribute('data-name');
                    break;
                }
            }
            searchInput.value = initialCategory;

            // Event listener for dropdown items
            dropdownItems.forEach(function(item) {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    var selectedCategory = e.target.getAttribute('data-name');
                    var selectedId = e.target.getAttribute('data-id');
                    searchInput.value = selectedCategory;
                    hiddenInput.value = selectedId;
                });
            });

            // Filter dropdown items based on search
            optionSearchInput.addEventListener('input', function() {
                var filter = optionSearchInput.value.toLowerCase();
                dropdownItems.forEach(function(item) {
                    if (item.textContent.toLowerCase().includes(filter)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
        </script>
@endsection
