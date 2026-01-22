@extends('admin.layouts.master')
@section('title')
    Product Create
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product Module</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Add</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Product Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 offset-md-1 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Add Product form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('products.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @if (Auth::user()->role=='Admin')
                        <!--Merchant select -->
                        <div class="row mb-3">
                           <label for="merchant_id" class="col-md-3 col-form-label">Merchant Select</label>
                           <div class="col-md-9">
                               <select class="form-select " name="merchant_id">
                                   <option disabled selected>Please Select Merchant </option>
                                   @if ($merchants->count()>0)
                                   @foreach ($merchants as $merchant )
                                   <option value="{{$merchant->id}}">{{$merchant->name}} </option>
                                   @endforeach
                                   @else
                                   <option disabled class="text-danger ">Opps! Sorry, Merchant user not found! </option>
                                   @endif
                               </select>
                               <div class="text-danger">@error('merchant_id'){{ $message }} @enderror</div>
                           </div>
                       </div>
                       @else
                       <input type="hidden" name="merchant_id" value="{{Auth::user()->id}}">
                        @endif
                        <!-- Category -->
                        <div class="row mb-3">
                            <label for="category" class="col-md-3 col-form-label">Category Name</label>
                            <div class="col-md-9">
                                <div class="dropdown searchable-dropdown">
                                    <input type="text" id="search-input-category"  class="form-control"
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

                        <!-- Sub SubCategory -->
                        <div class="row mb-3">
                            <label for="sub_subcategory" class="col-md-3 col-form-label">Sub Sub-Category Name</label>
                            <div class="col-md-9">
                                <div class="dropdown searchable-dropdown">
                                    <input type="text" id="search-input-sub_subcategory" class="form-control"
                                        placeholder="Select Sub Sub-Category" data-toggle="dropdown" readonly>
                                    <div class="dropdown-menu" aria-labelledby="search-input-sub_subcategory">
                                        <input type="text" id="option-search-input-sub_subcategory" class="form-control"
                                            placeholder="Search...">
                                        <div id="subsubcategory-list">
                                            <!-- Sub Subcategories will be dynamically added here -->
                                        </div>
                                    </div>
                                </div>
                                <div class="text-danger">
                                    @error('sub_subcategory_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="sub_subcategory_id" id="sub_subcategory-id">
                        </div>

                        <!-- Brand -->
                        <div class="row mb-3">
                            <label for="brand" class="col-md-3 col-form-label">Brand Name</label>
                            <div class="col-md-9">
                                <div class="dropdown searchable-dropdown">
                                    <input type="text" id="search-input-brand" class="form-control"
                                        placeholder="Select Brand" data-toggle="dropdown" readonly>
                                    <div class="dropdown-menu" aria-labelledby="search-input-brand">
                                        <input type="text" id="option-search-input-brand" class="form-control"
                                            placeholder="Search...">
                                        @foreach ($brands as $brand)
                                            <a class="dropdown-item brand-item"
                                                data-id="{{ $brand->id }}">{{ $brand->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="text-danger"> @error('brand_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="brand_id" id="brand-id">

                        </div>

                        <!-- Unit -->
                        <div class="row mb-3">
                            <label for="unit" class="col-md-3 col-form-label">Unit Name</label>
                            <div class="col-md-9">
                                <div class="dropdown searchable-dropdown">
                                    <input type="text" id="search-input-unit" class="form-control"
                                        placeholder="Select Unit" data-toggle="dropdown" readonly>
                                    <div class="dropdown-menu" aria-labelledby="search-input-unit">
                                        <input type="text" id="option-search-input-unit" class="form-control"
                                            placeholder="Search...">
                                        @foreach ($units as $unit)
                                            <a class="dropdown-item unit-item"
                                                data-id="{{ $unit->id }}">{{ $unit->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="text-danger"> @error('unit_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="unit_id" id="unit-id">
                        </div>

                        <!--Nayem Start -->
                        <!--Color-->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Color Name</label>
                            <div class="col-md-9">
                                <select class="color js-states form-control px-1" name="color[]"  placeholder="select Color " multiple="multiple">
                                    <!-- Colors will be dynamically added here -->
                                </select>
                                <div class="text-danger">
                                    @error('color')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--Nayem End -->

                        <!--Size -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Size Name</label>
                            <div class="col-md-9">
                                <select class="size js-states form-control px-1" name="size[]"
                                    multiple="multiple">
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{$size->name}} </option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('size')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--Tag -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Tag Name</label>
                            <div class="col-md-9">
                                <select class="tag js-states form-control px-1" name="tag[]" placeholder="select Size "
                                    multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }} </option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('tag')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--name -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Product Name</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="Product Name">
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--code -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Product Code</label>
                            <div class="col-md-9">
                                <input type="text" name="code" class="form-control" placeholder="Product Code">
                                <div class="text-danger">
                                    @error('code')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--Product type -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Product Type</label>
                            <div class="col-md-9">
                                <select class="form-control" name="type">
                                    <option disabled selected>Select product type</option>
                                    <option value="1">Hot Product</option>
                                    <option value="2">Latest product </option>
                                    <option value="3">Popular product </option>
                                </select>
                                <div class="text-danger"> @error('type')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- short Description -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Short Description</label>
                            <div class="col-md-9">
                                <textarea cols="3" rows="3" name="short_description" placeholder="Short Description"
                                    class="form-control"></textarea>
                                <div class="text-danger">
                                    @error('short_description')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- long Description -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Long Description</label>
                            <div class="col-md-9">
                                <textarea cols="3" rows="3" id="summernote" name="long_description" placeholder="Long Description"
                                    class="form-control"></textarea>
                                <div class="text-danger">
                                    @error('long_description')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- product image -->
                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label">Product Image <br>
                                <small class="text-danger">File size should not exceed 1024 KB, and resolution should be between 200px-300px.</small></label>
                            <div class="col-md-9">
                                <input type="file" name="image" id="image" class="form-control">
                                <div id="image-preview" style="margin-top: 10px;"></div>
                                <div class="text-danger">
                                    @error('image')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- other  image -->
                        <div class="row mb-3">
                            <label for="other_image" class="col-md-3 col-form-label">Other Image <br>
                                <small class="text-danger">File size should not exceed 1024 KB, and resolution should be between 200px-300px.</small></label>
                            </label>
                            <div class="col-md-9">
                                <input type="file" id="other_image" name="other_image[]" multiple
                                    class="form-control">
                                <div class="row" id="image_preview"></div>
                                <div class="text-danger">
                                    @error('other_image')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!--Nayem Start -->
                        <div class="row mb-3">
                            <!-- Others Image One -->
                             <div class="col-md-3">
                                 <label for="image" class="col-md-12 col-form-label">Others Image One <br>
                                     <small class="text-danger">File size should not exceed 1024 KB, and resolution should be between 200px-300px.</small></label>

                                 <input type="file" name="image_one" id="image_one" class="form-control">
                                 <div id="image-preview-one" style="margin-top: 10px;"></div>
                                <div class="text-danger">
                                    @error('image_one')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <!--Others Image two-->
                            <div class="col-md-3">
                                <label for="image" class="col-md-12 col-form-label">Others Image Two <br>
                                    <small class="text-danger">File size should not exceed 1024 KB, and resolution should be between 200px-300px.</small></label>

                                <input type="file" name="image_two" id="image_two" class="form-control">
                                <div id="image-preview-two" style="margin-top: 10px;"></div>
                                <div class="text-danger">
                                    @error('image_two')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <!--Others Image three-->
                            <div class="col-md-3">
                                <label for="image" class="col-md-12 col-form-label">Others Image Three <br>
                                    <small class="text-danger">File size should not exceed 1024 KB, and resolution should be between 200px-300px.</small></label>

                                <input type="file" name="image_three" id="image_three" class="form-control">
                                <div id="image-preview-three" style="margin-top: 10px;"></div>
                                <div class="text-danger">
                                    @error('image_three')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <!--Others Image four-->
                            <div class="col-md-3">
                                <label for="image" class="col-md-12 col-form-label">Others Image Four <br>
                                    <small class="text-danger">File size should not exceed 1024 KB, and resolution should be between 200px-300px.</small></label>

                                <input type="file" name="image_four" id="image_four" class="form-control">
                                <div id="image-preview-four" style="margin-top: 10px;"></div>
                                <div class="text-danger">
                                    @error('image_four')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--Nayem End -->


                        <!-- product price  -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label"> Product Price </label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="regular_price" onkeyup="discountAmount()"  name="regular_price"
                                            placeholder="Regular Price ">
                                        <div class="text-danger">
                                            @error('regular_price')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" disabled="disabled" id="selling_price" name="selling_price"
                                            placeholder="Selling Price ">
                                        <div class="text-danger">
                                            @error('selling_price')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- product discount price  -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label"> Product Discount </label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-6">
                                        <select class="form-select" name="discount_type" id="discount_type">
                                            <option selected disabled >Select Discount Type</option>
                                            <option value="percentage">Percentage</option>
                                            <option value="flat" >Flat</option>
                                        </select>
                                        <div class="text-danger">@error('discount_type'){{$message}} @enderror</div>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" value="{{old('discount_amount')}}" onkeyup="discountAmount()" name="discount_amount" id="discount_amount" placeholder="Discount Amount"/>
                                        <div class="text-danger">@error('discount_amount'){{$message}} @enderror</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Stock Amounts -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Stock Amount </label>
                            <div class="col-md-9">
                                <input type="text" name="stock_amount" class="form-control"
                                    placeholder="Stock Amount ">
                                <div class="text-danger">
                                    @error('stock_amount')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--status-->
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
                                    <input class="form-check-input" type="radio" value="0"  name="status" id="status2">
                                    <label class="form-check-label" for="status2">
                                        Unpublished
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info ">Create new product</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    @include('admin.layouts.text-editor')

<script>
$(document).ready(function() {
    // Category dropdown item click event
    $('.category-item').on('click', function(e) {
        e.preventDefault();
        let categoryId = $(this).data('id');
        let categoryName = $(this).text().trim();

        $('#search-input-category').val(categoryName);
        $('#category-id').val(categoryId);


        // Clear previous subcategory and sub-subcategory selections
        $('#search-input-sub_category').val('');
        $('#sub-category-id').val('');
        $('#subcategory-list').empty();
        $('#search-input-sub_subcategory').val('');
        $('#sub_subcategory-id').val('');
        $('#subsubcategory-list').empty();

        // Fetch subcategories
        $.ajax({
            url: "{{url('get-subcategories')}}/" + categoryId,
            type: 'GET',
            success: function(response) {
                let subcategories = response.subcategories;

                if (subcategories.length > 0) {
                    subcategories.forEach(function(subcategory) {
                        $('#subcategory-list').append(
                            '<a class="dropdown-item sub-category-item" href="#" data-id="' +
                            subcategory.id + '">' + subcategory.name +
                            '</a>');
                    });

                    // Attach click event to new subcategory items
                    $('.sub-category-item').on('click', function(e) {
                        e.preventDefault();
                        let subcategoryId = $(this).data('id');
                        let subcategoryName = $(this).text().trim();

                        $('#search-input-sub_category').val(subcategoryName);
                        $('#sub-category-id').val(subcategoryId);

                        // Clear previous sub-subcategory selections
                        $('#search-input-sub_subcategory').val('');
                        $('#sub_subcategory-id').val('');
                        $('#subsubcategory-list').empty();

                        // Fetch sub-subcategories
                        $.ajax({
                            url: "{{url('get-subsubcategories')}}/" + subcategoryId,
                            type: 'GET',
                            success: function(response) {
                                let subsubcategories = response
                                    .subsubcategories;
                                if (subsubcategories.length > 0) {
                                    subsubcategories.forEach(
                                        function(
                                        subsubcategory) {
                                            $('#subsubcategory-list')
                                                .append(
                                                    '<a class="dropdown-item sub-subcategory-item" href="#" data-id="' +
                                                    subsubcategory
                                                    .id + '">' +
                                                    subsubcategory
                                                    .name +
                                                    '</a>');
                                        });

                                    // Attach click event to new sub-subcategory items
                                    $('.sub-subcategory-item').on('click',
                                        function(e) {
                                            e.preventDefault();
                                            let subsubcategoryId = $(this).data('id');
                                            let subsubcategoryName =  $(this).text().trim();
                                            $('#search-input-sub_subcategory').val(subsubcategoryName);
                                            $('#sub_subcategory-id').val(subsubcategoryId);

                                            // Hide the sub-subcategory dropdown menu after selection
                                            $('#search-input-sub_subcategory').dropdown('toggle');
                                        });
                                }
                            }
                        });

                        // Hide the subcategory dropdown menu after selection
                        $('#search-input-sub_category').dropdown('toggle');
                    });
                }
            }
        });
    });

    // Prevent dropdown menu from closing on input focus
    $('#option-search-input-category, #option-search-input-sub_category, #option-search-input-sub_subcategory')
        .on('click', function(e) {
            e.stopPropagation();
        });

    // Search functionality for categories, subcategories, and sub-subcategories
    $('#option-search-input-category').on('keyup', function() {
        let searchValue = $(this).val().toLowerCase();
        $('.category-item').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
        });
    });

    $('#option-search-input-sub_category').on('keyup', function() {

        let searchValue = $(this).val().toLowerCase();

        $('.sub-category-item').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
        });
    });

    $('#option-search-input-sub_subcategory').on('keyup', function() {
        let searchValue = $(this).val().toLowerCase();
        $('.sub-subcategory-item').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
        });
    });
});
</script>

<!--Nayem Start -->
<script>
    $(document).ready(function () {
        // Existing category click event
        $('.category-item').on('click', function (e) {
            e.preventDefault();
            let categoryId = $(this).data('id');
            let categoryName = $(this).text().trim();

            $('#search-input-category').val(categoryName);
            $('#category-id').val(categoryId);

            // Clear other dependent fields
            $('#search-input-sub_category, #search-input-sub_subcategory').val('');
            $('#sub-category-id, #sub_subcategory-id').val('');
            $('#subcategory-list, #subsubcategory-list').empty();

            // Fetch subcategories as before (your existing logic)

            // Fetch colors for the selected category
            $.ajax({
                url: "{{ url('get-colors') }}/" + categoryId,
                type: 'GET',
                success: function (response) {
                    let colors = response.colors;

                    // Clear the color dropdown
                    $('.color').empty();

                    if (colors.length > 0) {
                        colors.forEach(function (color) {
                            $('.color').append(
                                '<option value="' + color.id + '">' + color.name + '</option>'
                            );
                        });
                    }
                },
                error: function () {
                    alert('Error fetching colors. Please try again.');
                },
            });
        });

        // Multi-select initialization with placeholder
        $('.color').select2({
            placeholder: "Select Color",
            allowClear: true,
        });
    });
</script>
<!--Nayem End-->

<script>

    function discountAmount(){
         let discount_amount =  $('#discount_amount').val()
         let discountType =  $('#discount_type').val()
         let regular_price =  $('#regular_price').val()

        let selling_price = '';
        if(discountType == 'percentage'){
            selling_price = (regular_price - (regular_price * discount_amount) / 100)
             $('#selling_price').val(selling_price)
        }else if(discountType == 'flat'){
            selling_price = (regular_price - discount_amount)
            $('#selling_price').val(selling_price)
        }else{
            $('#selling_price').val('');
        }

    }

    $(document).ready(function () {
        // Trigger validation on form submission
        $('form').on('submit', function (e) {
            let isValid = true;

            // Clear previous error messages
            $('.text-danger').text('');



            // Validate Category
            const category = $('#category-id').val();
            if (!category) {
                isValid = false;
                $('#search-input-category').next('.text-danger').text('Please select a category.');
            }

            // Validate Subcategory
            const subCategory = $('#sub-category-id').val();
            if (!subCategory) {
                isValid = false;
                $('#search-input-sub_category').next('.text-danger').text('Please select a subcategory.');
            }

            // Validate Product Name
            const productName = $('input[name="name"]').val().trim();
            if (!productName) {
                isValid = false;
                $('input[name="name"]').next('.text-danger').text('Product name is required.');
            }
            // Validate Product Code
            const code = $('input[name="code"]').val().trim();
            if (!code) {
                isValid = false;
                $('input[name="code"]').next('.text-danger').text('Product code  is required.');
            }
            // Validate Stock Amount
            const stockAmount = $('input[name="stock_amount"]').val().trim();
            if (!stockAmount) {
                isValid = false;
                $('input[name="stock_amount"]').next('.text-danger').text('Stock amount field is  required.');
            }
             // Validate type
             if ($('select[name="type"]').length > 0) {
                const type = $('select[name="type"]').val();
                if (!type) {
                    isValid = false;
                    $('select[name="type"]').next('.text-danger').text('Please select product type.');
                }
            }

            // Validate Regular Price (Numeric Check)
            const regularPrice = $('input[name="regular_price"]').val().trim();
            if (!regularPrice || isNaN(regularPrice)) {
                isValid = false;
                $('input[name="regular_price"]').next('.text-danger').text('Regular price must be a valid number.');
            }

            // Validate Selling Price (Numeric Check)
            // const sellingPrice = $('input[name="selling_price"]').val().trim();
            // if (!sellingPrice || isNaN(sellingPrice)) {
            //     isValid = false;
            //     $('input[name="selling_price"]').next('.text-danger').text('Selling price must be a valid number.');
            // }

            if ($('#discount_amount').val() && isNaN($('#discount_amount').val())) {
                valid = false;
                $('#discount_amount').next('.text-danger').text('Discount must be a valid number.');
            }
            // Validate Short Description
            const shortDescription = $('textarea[name="short_description"]').val().trim();
            if (!shortDescription) {
                isValid = false;
                $('textarea[name="short_description"]').next('.text-danger').text('Short description is required.');
            } else if (shortDescription.length < 10) {
                isValid = false;
                $('textarea[name="short_description"]').next('.text-danger').text('Short description must be at least 10 characters.');
            }


            // Prevent form submission if invalid
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
</script>

<!--Nayem Start -->
<!--image preview code -->
<script>
$(document).ready(function () {
    // Function to handle image preview
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                $(previewId).html(`<img src="${e.target.result}" alt="Image Preview" style="width: 100%; height: 100px; border: 1px solid #ccc; padding: 5px;">`);
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            $(previewId).html('<small class="text-muted">No image selected.</small>');
        }
    }

    // Image One Preview
    $('#image_one').change(function () {
        previewImage(this, '#image-preview-one');
    });

    // Image Two Preview
    $('#image_two').change(function () {
        previewImage(this, '#image-preview-two');
    });

    // Image Three Preview
    $('#image_three').change(function () {
        previewImage(this, '#image-preview-three');
    });

    // Image Four Preview
    $('#image_four').change(function () {
        previewImage(this, '#image-preview-four');
    });
});
</script>
<!--Nayem End -->

    <script>
        $(document).ready(function() {
            // Category dropdown item click event
            $('.category-item').on('click', function(e) {
                e.preventDefault();
                let categoryId = $(this).data('id');
                let categoryName = $(this).text().trim();

                $('#search-input-category').val(categoryName);
                $('#category-id').val(categoryId);


                // Clear previous subcategory and sub-subcategory selections
                $('#search-input-sub_category').val('');
                $('#sub-category-id').val('');
                $('#subcategory-list').empty();
                $('#search-input-sub_subcategory').val('');
                $('#sub_subcategory-id').val('');
                $('#subsubcategory-list').empty();

                // Fetch subcategories
                $.ajax({
                    url: "{{url('get-subcategories')}}/" + categoryId,
                    type: 'GET',
                    success: function(response) {
                        let subcategories = response.subcategories;

                        if (subcategories.length > 0) {
                            subcategories.forEach(function(subcategory) {
                                $('#subcategory-list').append(
                                    '<a class="dropdown-item sub-category-item" href="#" data-id="' +
                                    subcategory.id + '">' + subcategory.name +
                                    '</a>');
                            });

                            // Attach click event to new subcategory items
                            $('.sub-category-item').on('click', function(e) {
                                e.preventDefault();
                                let subcategoryId = $(this).data('id');
                                let subcategoryName = $(this).text().trim();

                                $('#search-input-sub_category').val(subcategoryName);
                                $('#sub-category-id').val(subcategoryId);

                                // Clear previous sub-subcategory selections
                                $('#search-input-sub_subcategory').val('');
                                $('#sub_subcategory-id').val('');
                                $('#subsubcategory-list').empty();

                                // Fetch sub-subcategories
                                $.ajax({
                                    url: "{{url('get-subsubcategories')}}/" + subcategoryId,
                                    type: 'GET',
                                    success: function(response) {
                                        let subsubcategories = response
                                            .subsubcategories;
                                        if (subsubcategories.length > 0) {
                                            subsubcategories.forEach(
                                                function(
                                                    subsubcategory) {
                                                    $('#subsubcategory-list')
                                                        .append(
                                                            '<a class="dropdown-item sub-subcategory-item" href="#" data-id="' +
                                                            subsubcategory
                                                                .id + '">' +
                                                            subsubcategory
                                                                .name +
                                                            '</a>');
                                                });

                                            // Attach click event to new sub-subcategory items
                                            $('.sub-subcategory-item').on('click',
                                                function(e) {
                                                    e.preventDefault();
                                                    let subsubcategoryId = $(this).data('id');
                                                    let subsubcategoryName =  $(this).text().trim();
                                                    $('#search-input-sub_subcategory').val(subsubcategoryName);
                                                    $('#sub_subcategory-id').val(subsubcategoryId);

                                                    // Hide the sub-subcategory dropdown menu after selection
                                                    $('#search-input-sub_subcategory').dropdown('toggle');
                                                });
                                        }
                                    }
                                });

                                // Hide the subcategory dropdown menu after selection
                                $('#search-input-sub_category').dropdown('toggle');
                            });
                        }
                    }
                });
            });

            // Prevent dropdown menu from closing on input focus
            $('#option-search-input-category, #option-search-input-sub_category, #option-search-input-sub_subcategory')
                .on('click', function(e) {
                    e.stopPropagation();
                });

            // Search functionality for categories, subcategories, and sub-subcategories
            $('#option-search-input-category').on('keyup', function() {
                let searchValue = $(this).val().toLowerCase();
                $('.category-item').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
                });
            });

            $('#option-search-input-sub_category').on('keyup', function() {

                let searchValue = $(this).val().toLowerCase();

                $('.sub-category-item').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
                });
            });

            $('#option-search-input-sub_subcategory').on('keyup', function() {
                let searchValue = $(this).val().toLowerCase();
                $('.sub-subcategory-item').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
                });
            });
        });




        // =====================add Product compare============.
        $(document).on('change', '.pr_id', function() {
            var this_element=$(this);
            var prPricelist = this_element.find(':selected').data('rate');
            this_element.parents('tr').find('.pr_price').val(prPricelist)

        });
        $(document).on('click', '.add , .newb', function() {
            var item_list = '<tr class="in_tr">';
            item_list += '<td style="width: 45%"  >';
            item_list += '<input type="text" class="form-control key_name w-100 w-md-100"  name="key_name[]" value="" style="width: 200px" />';
            item_list += '</td>';
            item_list += '<td style="width: 45%">';
            item_list += '<input type="text" class="form-control key_value w-100  w-md-100" step="any"  name="key_value[]" value="" />';
            item_list += '</td>';
            item_list += '<td style="width: 10%">';
            item_list += '<button type="button" class="cut btn btn-danger btn-sm w-100" data-toggle="modal" data-target="" data-id="">Delete</button>';
            item_list += '</td>';
            item_list += '</tr>';

            $('.inventory').append(item_list);
        });
        $(document).on('click', '.cut', function() {
            var thisElement = $(this);
            var parentTr = thisElement.parents('tr.in_tr').remove();
            pr_ttl_price_arr = 0
            $("tr.in_tr").each(function(index) {
                var pr_ttl_pricen = $(this).find('.pr_ttl_price').val() || 0;
                pr_ttl_price_arr += parseInt(pr_ttl_pricen);

            });
            $("#net_total").val(pr_ttl_price_arr);
            $("#purchase_amount ").val(pr_ttl_price_arr);
            // $('.inventory tr:last').remove();
        });

        function cut_item_p() {
            $('.purchases tr:last').remove();
        }
    </script>



@endsection
