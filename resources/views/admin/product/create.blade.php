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
                        @if (Auth::user()->role == 'Admin')
                            <!--Merchant select -->
                            <div class="row mb-3">
                                <label for="merchant_id" class="col-md-3 col-form-label">Merchant Select</label>
                                <div class="col-md-9">
                                    <select class="form-select " name="merchant_id">
                                        <option disabled selected >Please Select Merchant </option>
                                        @if ($merchants->count() > 0)
                                            @foreach ($merchants as $merchant)
                                                <option value="{{ $merchant->id }}">{{ $merchant->name }} </option>
                                            @endforeach
                                        @else
                                            <option disabled class="text-danger ">Opps! Sorry, Merchant user not found!
                                            </option>
                                        @endif
                                    </select>
                                    <div class="text-danger">@error('merchant_id'){{ $message }}@enderror</div>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="merchant_id" value="{{ Auth::user()->id }}">
                        @endif

                        <!-- Category,subcategory,sub-subcategory,brand -->
                        <div class="row mb-3">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="category" class="col col-form-label">Category Name</label>
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
                                        <input type="hidden" name="category_id" id="category-id">
                                    </div>
                                </div>
                                <div class="text-danger " >@error('category_id') {{ $message }} @enderror</div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="sub_category" class="col  col-form-label">Sub Category Name</label>
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
                                <input type="hidden" name="sub_category_id" id="sub-category-id">
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="sub_sub_category" class="col  col-form-label">Sub Sub-Category Name</label>
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
                                <input type="hidden" name="sub_subcategory_id" id="sub_subcategory-id">
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="brand" class="col col-form-label">Brand Name </label>
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
                                <input type="hidden" name="brand_id" id="brand-id">
                            </div>
                        </div>
                        <!-- unit , color , size,tag -->
                        <div class="row mb-3">
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="unit" class="col  col-form-label">Unit Name</label>
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
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="color" class="col  col-form-label">Color Name</label>

                                <select class="color js-states form-control px-1" name="color[]" multiple="multiple">
                                    <!-- Colors will be dynamically added here -->
                                </select>
                                <div class="text-danger">
                                    @error('color') {{ $message }} @enderror
                                </div>

                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="size" class="col  col-form-label">Size Name</label>
                                <select class="size js-states form-control px-1" name="size[]"
                                    placeholder="select Size " multiple="multiple">
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->name }} </option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('size')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="size" class="col  col-form-label">Tag Name</label>
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

                        <!-- product name, code,type -->
                        <div class="row mb-3">
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="product_Name" class="col  col-form-label">Product Name</label>
                                <input type="text" name="name" id="product_Name" class="form-control"
                                    placeholder="Product Name">
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="p_code" class="col  col-form-label">Product Code</label>
                                <input type="text" name="code" id="p_code" class="form-control"
                                    placeholder="Product Code">
                                <div class="text-danger">
                                    @error('code')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="size" class="col  col-form-label">Product type</label>
                                <select class="form-control" name="type">
                                    <option disabled selected>Select product type</option>
                                    <option value="1">Hot</option>
                                    <option value="2">Latest</option>
                                    <option value="3">Popular</option>
                                    <option value="4">Recommendation for you</option>
                                    <option value="5">DealPrime picks</option>
                                    <option value="6">Feature</option>
                                    <option value="7">Seasonal Favourite</option>
                                </select>
                                <div class="text-danger"> @error('type')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- product name, code,type -->
                        <!-- product price  -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label"> Product Price </label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="regular_price"
                                            onkeyup="discountAmount()" name="regular_price" placeholder="Regular Price ">
                                        <div class="text-danger">
                                            @error('regular_price')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" disabled="disabled"
                                            id="selling_price" name="selling_price" placeholder="Selling Price ">
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
                                            <option selected value="0">Select Discount Type</option>
                                            <option value="percentage">Percentage</option>
                                            <option value="flat">Flat</option>
                                        </select>
                                        <div class="text-danger">
                                            @error('discount_type')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" value="{{ old('discount_amount') }}"
                                            onkeyup="discountAmount()" name="discount_amount" id="discount_amount"
                                            placeholder="Discount Amount" />
                                        <div class="text-danger">
                                            @error('discount_amount')
                                                {{ $message }}
                                            @enderror
                                        </div>

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
                        <!-- short,long description start -->
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
                        <!-- product image,other  image -->
                        <!--image-->
                        <div class="row mb-3">
                            <div class="form-group col-6 col-md-6">
                                <label for="product_image" class="col col-form-label">Product Image </label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                <small class="form-text text-muted">Image size should be 300x300 pixels.</small>
                                <div class="text-danger">@error('image'){{ $message }}@enderror</div>
                                <small id="errorMessage" class="form-text text-danger"></small>
                                <div id="image-preview" ></div>
                            </div>
                            <!--product other image-->
                            <div class="form-group col-6 col-md-6">
                                <label for="other_image" class="col col-form-label">Other Image</label>
                                <input type="file" id="other_image" name="other_image[]" multiple class="form-control" accept="image/*">
                                <small class="form-text text-muted">Image size should be 500x500 pixels.</small>
                                <div class="form-text text-danger" id="multipleImgError"></div>
                                <div class="text-danger"> @error('other_image'){{ $message }}@enderror</div>
                                <div class="row" id="multipleImagePreview"></div>
                            </div>



                        </div>
                        <!-- product image,other  image end -->
                        <!-- product 4 others image start -->
                        <div class="row mb-3">
                            <!-- Image One -->
                            <div class="col-md-3">
                                <label for="image_one" class="col-md-12 col-form-label">Others Image One </label><br>
                                <input type="file" name="image_one" id="image_one" class="form-control" accept="image/*">
                                <small class="form-text text-muted">Image size should be 500x500 pixels.</small>
                                <div id="image-preview-one" style="margin-top: 10px;"></div>
                                <div class="text-danger" id="error-message-one"></div>
                            </div>

                            <!-- Image Two -->
                            <div class="col-md-3">
                                <label for="image_two" class="col-md-12 col-form-label">Others Image Two</label> <br>
                                <input type="file" name="image_two" id="image_two" class="form-control" accept="image/*">
                                <small class="form-text text-muted">Image size should be 500x500 pixels.</small>
                                <div id="image-preview-two" style="margin-top: 10px;"></div>
                                <div class="text-danger" id="error-message-two"></div>
                            </div>

                            <!-- Image Three -->
                            <div class="col-md-3">
                                <label for="image_three" class="col-md-12 col-form-label">Others Image Three </label> <br>
                                <input type="file" name="image_three" id="image_three" class="form-control" accept="image/*">
                                <small class="form-text text-muted">Image size should be 500x500 pixels.</small>
                                <div id="image-preview-three" style="margin-top: 10px;"></div>
                                <div class="text-danger" id="error-message-three"></div>
                            </div>

                            <!-- Image Four -->
                            <div class="col-md-3">
                                <label for="image_four" class="col-md-12 col-form-label">Others Image Four </label> <br>
                                <input type="file" name="image_four" id="image_four" class="form-control" accept="image/*">
                                <small class="form-text text-muted">Image size should be 500x500 pixels.</small>
                                <div id="image-preview-four" style="margin-top: 10px;"></div>
                                <div class="text-danger" id="error-message-four"></div>
                            </div>
                        </div>
                        <!-- product 4 others image end -->
                        <div class="row mb-3">
                            <div class="col-12 col-md-12">
                                <article>
                                    <button type="button" class="add btn btn-primary btn-sm  permission_set "
                                        data-toggle="modal" data-id="">Add</button>
                                    <table class="table table-responsive table-striped table-bordered  ">
                                        <thead>
                                            <th style="width: 45%;padding: 5px"><span>Heading Name</span></th>
                                            <th style="width: 45%;padding: 5px"><span>Value</span></th>
                                            <th style="width: 10%;padding: 5px"><span>Remove</span></th>
                                        </thead>
                                        <tbody class="inventory">

                                        </tbody>
                                    </table>
                                </article>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="advance_pay1" class="col-md-6 pt-0 col-form-label">Advance Payment</label><br>
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" name="advance_pay"
                                           id="advance_pay1" onclick="togglePaymentField()">
                                    <label class="form-check-label" for="advance_pay1">
                                        Yes
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0" name="advance_pay" checked
                                           id="advance_pay2" onclick="togglePaymentField()">
                                    <label class="form-check-label" for="advance_pay2">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6  " id="paymentField" style="display: none;">
                                <label for="payment_amount" class="col-form-label p-0">Advance Amount</label>
                                <input type="number" class="form-control" id="payment_amount" name="advance_pay_amount" placeholder="Enter amount">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="flasSale1" class="col-md-6 pt-0 col-form-label">Flash Sale</label><br>
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" name="flash_sale"
                                           id="flasSale1">
                                    <label class="form-check-label" for="flasSale1">
                                        On
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0" name="flash_sale" checked
                                           id="flasSale2">
                                    <label class="form-check-label" for="flasSale2">
                                        Off
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="description" class="col-md-4 pt-0 col-form-label">Status</label><br>
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" name="status" checked
                                           id="status1">
                                    <label class="form-check-label" for="status1">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0" name="status"
                                           id="status2">
                                    <label class="form-check-label" for="status2">
                                        Unpublished
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--status-->
                        <div class="row d-flex justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-info">Create new product</button>
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
            // Existing category click event
            $('.category-item').on('click', function(e) {
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
                    success: function(response) {
                        let colors = response.colors;

                        // Clear the color dropdown
                        $('.color').empty();

                        if (colors.length > 0) {
                            colors.forEach(function(color) {
                                $('.color').append(
                                    '<option value="' + color.id + '">' + color
                                    .name + '</option>'
                                );
                            });
                        }
                    },
                    error: function() {
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
                    url: "{{ url('get-subcategories') }}/" + categoryId,
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
                                $('.dropdown-menu').hide();

                                // Clear previous sub-subcategory selections
                                $('#search-input-sub_subcategory').val('');
                                $('#sub_subcategory-id').val('');
                                $('#subsubcategory-list').empty();

                                // Fetch sub-subcategories
                                $.ajax({
                                    url: "{{ url('get-subsubcategories') }}/" +
                                        subcategoryId,
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
                                            $('.sub-subcategory-item').on(
                                                'click',
                                                function(e) {
                                                    e.preventDefault();
                                                    let subsubcategoryId =
                                                        $(this).data(
                                                            'id');
                                                    let subsubcategoryName =
                                                        $(this).text()
                                                        .trim();
                                                    $('#search-input-sub_subcategory')
                                                        .val(
                                                            subsubcategoryName
                                                            );
                                                    $('#sub_subcategory-id')
                                                        .val(
                                                            subsubcategoryId
                                                            );
                                                    $('.dropdown-menu').hide();
                                                    // Hide the sub-subcategory dropdown menu after selection
                                                    // $('#search-input-sub_subcategory')
                                                    //     .dropdown(
                                                    //         'toggle');
                                                });
                                        }
                                    }
                                });
                                $('.dropdown-menu').hide();
                                // Hide the subcategory dropdown menu after selection
                                // $('#search-input-sub_category').dropdown('toggle');
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
        // $(document).on('change', '.pr_id', function() {
        //     var this_element=$(this);
        //     var prPricelist = this_element.find(':selected').data('rate');
        //     this_element.parents('tr').find('.pr_price').val(prPricelist)
        //
        // });
        $(document).on('click', '.add , .newb', function() {
            var item_list = '<tr class="in_tr">';
            item_list += '<td style="width: 45%;padding: 5px"  >';
            item_list +=
                '<input type="text" class="form-control key_name w-100 w-md-100"  name="key_name[]" value="" style="width: 200px" />';
            item_list += '</td>';
            item_list += '<td style="width: 45%;padding: 5px">';
            item_list +=
                '<input type="text" class="form-control key_value w-100  w-md-100" step="any"  name="key_value[]" value="" />';
            item_list += '</td>';
            item_list += '<td style="width: 10%;padding: 5px">';
            item_list +=
                '<button type="button" class="cut btn btn-danger  w-20" data-toggle="modal" data-target="" data-id=""><i class="fa fa-trash"></i></button>';
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

    <script>
        function discountAmount() {
            let discount_amount = $('#discount_amount').val()
            let discountType = $('#discount_type').val()
            let regular_price = $('#regular_price').val()

            let selling_price = '';
            if (discountType == 'percentage') {
                selling_price = (regular_price - (regular_price * discount_amount) / 100)
                $('#selling_price').val(selling_price)
            } else if (discountType == 'flat') {
                selling_price = (regular_price - discount_amount)
                $('#selling_price').val(selling_price)
            } else {
                $('#selling_price').val('');
            }

        }


        // $(document).ready(function () {
        //     $("form").on("submit", function (e) {
        //         let isValid = true;

        //         // Validate Merchant Select (if visible)
        //         if ($("select[name='merchant_id']").is(":visible")) {
        //             const merchant = $("select[name='merchant_id']").val();
        //             if (!merchant) {
        //                 isValid = false;
        //                 showError($("select[name='merchant_id']"), "Please select a merchant.");
        //             } else {
        //                 removeError($("select[name='merchant_id']"));
        //             }
        //         }

        //         // Validate Category
        //         const category = $("#category-id").val();
        //         if (!category) {
        //             isValid = false;
        //             showError($("#search-input-category"), "Please select a category.");
        //         } else {
        //             removeError($("#search-input-category"));
        //         }

        //         // Validate Sub-Category
        //         const subCategory = $("#sub-category-id").val();
        //         if (!subCategory) {
        //             isValid = false;
        //             showError($("#search-input-sub_category"), "Please select a sub-category.");
        //         } else {
        //             removeError($("#search-input-sub_category"));
        //         }

        //         // Validate Sub Sub-Category
        //         const subSubCategory = $("#sub_subcategory-id").val();
        //         if (!subSubCategory) {
        //             isValid = false;
        //             showError($("#search-input-sub_subcategory"), "Please select a sub sub-category.");
        //         } else {
        //             removeError($("#search-input-sub_subcategory"));
        //         }

        //         // Validate Brand
        //         const brand = $("#brand-id").val();
        //         if (!brand) {
        //             isValid = false;
        //             showError($("#search-input-brand"), "Please select a brand.");
        //         } else {
        //             removeError($("#search-input-brand"));
        //         }

        //         // Validate Unit
        //         const unit = $("#unit-id").val();
        //         if (!unit) {
        //             isValid = false;
        //             showError($("#search-input-unit"), "Please select a unit.");
        //         } else {
        //             removeError($("#search-input-unit"));
        //         }

        //         // Validate Colors (multi-select)
        //         const colors = $("select[name='color[]']").val();
        //         if (!colors || colors.length === 0) {
        //             isValid = false;
        //             showError($("select[name='color[]']"), "Please select at least one color.");
        //         } else {
        //             removeError($("select[name='color[]']"));
        //         }

        //         // Validate Sizes (multi-select)
        //         const sizes = $("select[name='size[]']").val();
        //         if (!sizes || sizes.length === 0) {
        //             isValid = false;
        //             showError($("select[name='size[]']"), "Please select at least one size.");
        //         } else {
        //             removeError($("select[name='size[]']"));
        //         }

        //         // Validate Tags (multi-select)
        //         const tags = $("select[name='tag[]']").val();
        //         if (!tags || tags.length === 0) {
        //             isValid = false;
        //             showError($("select[name='tag[]']"), "Please select at least one tag.");
        //         } else {
        //             removeError($("select[name='tag[]']"));
        //         }

        //         // Prevent form submission if validation fails
        //         if (!isValid) {
        //             e.preventDefault();
        //             alert("Please fix the errors before submitting the form.");
        //         }
        //     });

        //     // Function to show error
        //     function showError(element, message) {
        //         const errorDiv = element.siblings(".text-danger");
        //         errorDiv.text(message);
        //         element.addClass("is-invalid");
        //     }

        //     // Function to remove error
        //     function removeError(element) {
        //         const errorDiv = element.siblings(".text-danger");
        //         errorDiv.text("");
        //         element.removeClass("is-invalid");
        //     }
        // });

        $(document).ready(function () {
        // $('#image').change(function () {
        //     let file = this.files[0];
        //     let errorMessage = $('#error-message');
        //     // Reset error message
        //     errorMessage.text('');
        //     // Validate file size (2MB = 2 * 1024 * 1024 bytes)
        //     if (file.size > 2 * 1024 * 1024) {
        //         errorMessage.text('File size must not exceed 2MB.');
        //         return;
        //     }
        //     // Validate image resolution
        //     let img = new Image();
        //     img.onload = function () {
        //         if (this.width > 1920 || this.height > 1080) {
        //             errorMessage.text('Image dimensions should not exceed 1920x1080 pixels.');
        //         }
        //         if (this.width !== 300 || this.height !== 300) {
        //             errorMessage.text('Image dimensions must be exactly 300x300 pixels.');
        //             event.target.value = ''; // Clear the input
        //         }
        //     };
        //     img.onerror = function () {
        //         errorMessage.text('Invalid image file.');
        //     };
        //     img.src = URL.createObjectURL(file);
        // });

            $('#uploadForm').submit(function (e) {
                // Prevent form submission if there's an error
                if ($('#error-message').text() !== '') {
                    e.preventDefault();
                }
            });
        });

    </script>

    <script>
        document.getElementById('image').addEventListener('change', function (event) {
            const errorMessage = document.getElementById('errorMessage');
            const image_preview = document.getElementById('image-preview');
            const file = event.target.files[0];

            // Clear previous error message
            errorMessage.textContent = '';

            if (file) {
                const maxSizeInBytes = 2 * 1024 * 1024; // 2 MB limit (example size)
                const requiredWidth = 300; // Required width
                const requiredHeight = 300; // Required height

                // Check file size
                if (file.size > maxSizeInBytes) {
                    errorMessage.textContent = 'File size must not exceed 2 MB.';
                    event.target.value = ''; // Clear the input
                    return;
                }

                // Check file type
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    errorMessage.textContent = 'Only image files are allowed.';
                    event.target.value = ''; // Clear the input
                    return;
                }

                // Check resolution
                const img = new Image();
                img.onload = function () {
                    if (this.width !== requiredWidth || this.height !== requiredHeight) {
                        errorMessage.textContent = `Image dimensions must be exactly ${requiredWidth}x${requiredHeight} pixels.`;
                        event.target.value = '';
                        image_preview.style.display = 'none'// Clear the input
                    }else{
                        image_preview.style.display = 'block'
                    }
                };
                img.onerror = function () {
                    errorMessage.textContent = 'Invalid image file.';
                    event.target.value = ''; // Clear the input
                };
                img.src = URL.createObjectURL(file);
            }
        });
    </script>

   <!-- nayem 02-01-25 -->
<script>

    $(document).ready(function () {
        $('#other_image').on('change', function (e) {
            // Clear previous error messages and previews
            $('#multipleImgError').text('');
            $('#multipleImagePreview').html('');
            //**** For maximum file upload range
            const minFiles = 5;
            const maxFiles = 60;
            if (this.files.length < minFiles) {
                alert(`Please select at least ${minFiles} files.`);
                this.value = ""; // Clear the input
            } else if (this.files.length > maxFiles) {
                alert(`You can only select up to ${maxFiles} files.`);
                this.value = ""; // Clear the input
            }
            let files = e.target.files;
            let isValid = true; // Flag to track if all images are valid

            $.each(files, function (index, file) {
                // Check if the file is an image
                if (!file.type.startsWith('image/')) {
                    isValid = false;
                    $('#multipleImgError').text('Only image files are allowed.');
                    return false; // Stop further processing
                }

                let img = new Image();
                img.src = URL.createObjectURL(file);

                img.onload = function () {
                    // Validate image size (500x500)
                    if (img.width !== 500 || img.height !== 500) {
                        isValid = false;
                        $('#multipleImgError').text('Each image must be 500x500 pixels.');
                        return; // Skip this image
                    }

                    // Display image preview only if size is valid
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        let image = $('<img>')
                            .attr('src', e.target.result)
                            .addClass('img-thumbnail')
                            .css('height', '70px')
                            .css('width', '100px')
                            .css('margin', '2px');
                        $('#multipleImagePreview').append(image);
                    };
                    reader.readAsDataURL(file);
                };
            });

            // Prevent form submission if validation fails
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Validation function
        function validateImage(input, previewId, errorMessageId) {
            const file = input.files[0];
            const errorMessage = $("#" + errorMessageId);
            const imagePreview = $("#" + previewId);
            const maxSizeInBytes = 2 * 1024 * 1024; // 2 MB limit
            const requiredWidth = 500; // Required width
            const requiredHeight = 500; // Required height

            // Clear previous error message and preview
            errorMessage.text('');
            imagePreview.hide();

            if (file) {
                // Check file size
                if (file.size > maxSizeInBytes) {
                    errorMessage.text('File size must not exceed 2 MB.');
                    $(input).val(''); // Clear the input
                    return;
                }

                // Check file type
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    errorMessage.text('Only image files (jpeg, png, gif) are allowed.');
                    $(input).val(''); // Clear the input
                    return;
                }

                // Check image dimensions (width and height)
                const img = new Image();
                img.onload = function() {
                    if (this.width !== requiredWidth || this.height !== requiredHeight) {
                        errorMessage.text(`Image dimensions must be exactly ${requiredWidth}x${requiredHeight} pixels.`);
                        $(input).val(''); // Clear the input
                        imagePreview.hide(); // Hide the preview
                    } else {
                        // Show the preview
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.html(`<img src="${e.target.result}" alt="Image Preview" style="width: 100%; height: 100px; border: 1px solid #ccc; padding: 5px;">`);
                        };
                        reader.readAsDataURL(file);
                        imagePreview.show(); // Show the preview
                    }
                };
                img.onerror = function() {
                    errorMessage.text('Invalid image file.');
                    $(input).val(''); // Clear the input
                };
                img.src = URL.createObjectURL(file);
            }
        }

        // Validate Image One
        $('#image_one').change(function() {
            validateImage(this, 'image-preview-one', 'error-message-one');
        });

        // Validate Image Two
        $('#image_two').change(function() {
            validateImage(this, 'image-preview-two', 'error-message-two');
        });

        // Validate Image Three
        $('#image_three').change(function() {
            validateImage(this, 'image-preview-three', 'error-message-three');
        });

        // Validate Image Four
        $('#image_four').change(function() {
            validateImage(this, 'image-preview-four', 'error-message-four');
        });
    });
</script>
<!-- //nayem 02-01-25 -->

 <script>
        function togglePaymentField() {
            var paymentField = document.getElementById("paymentField");
            var advancePayYes = document.getElementById("advance_pay1").checked;

            if (advancePayYes) {
                paymentField.style.display = "block";
            } else {
                paymentField.style.display = "none";
            }
        }
    </script>
    @endsection
