@extends('admin.layouts.master')
@section('title')
    Product Edit
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product Manage</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Edit</li>
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
                    <h4 class="header-title">Edit Product form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" id="productId" value="{{ $product->id }}">
                        @if (Auth::user()->role == 'Admin')
                            <!--Merchant select -->
                            <div class="row mb-3">
                                <label for="merchant_id" class="col-md-3 col-form-label">Merchant Select</label>
                                <div class="col-md-9">
                                    <select class="form-select " name="merchant_id">
                                        <option disabled selected>Please Select Merchent </option>
                                        @if ($merchants->count() > 0)
                                            @foreach ($merchants as $merchant)
                                                <option
                                                    value="{{ $merchant->id }}"{{ $merchant->id == $product->merchant_id ? 'selected' : '' }}>
                                                    {{ $merchant->name }} </option>
                                            @endforeach
                                        @else
                                            <option disabled class="text-danger ">Opps! Sorry, Merchant user not found!
                                            </option>
                                        @endif
                                    </select>
                                    <div class="text-danger">
                                        @error('merchant_id')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="merchant_id" value="{{ Auth::user()->id }}">
                        @endif

                        <!--category,subcategory,subsubcategory,brand--->
                        <div class="row mb-3">
                            <!-- Category -->
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="category" class="col-form-label">Category Name</label>
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
                                <input type="hidden" name="category_id" id="category-id">
                            </div>

                            <!-- Subcategory -->
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="sub_category" class="col-form-label">Sub Category Name</label>
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

                            <!-- Sub Sub-Category -->
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="sub_subcategory" class="col-form-label">Sub Sub-Category Name</label>
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
                                <input type="hidden" name="sub_subcategory_id" id="sub_subcategory-id"
                                    value="{{ old('sub_subcategory_id') ?? $product->sub_subcategory_id }}">
                            </div>

                            <!-- Brand -->
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="brand" class="col-form-label">Brand Name</label>
                                <div class="dropdown searchable-dropdown">
                                    <input type="text" id="search-input-brand" class="form-control"
                                        placeholder="Select Brand" data-toggle="dropdown" readonly>
                                    <div class="dropdown-menu" aria-labelledby="search-input-brand">
                                        <input type="text" id="option-search-input-brand" class="form-control"
                                            placeholder="Search...">
                                        @foreach ($brands as $brand)
                                            <a class="dropdown-item"
                                                data-id="{{ $brand->id }}">{{ $brand->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="text-danger">
                                    @error('brand_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <input type="hidden" name="brand_id" id="brand-id">
                            </div>
                        </div>
                        <!--//category,subcategory,subsubcategory,brand--->

                        <!--Unit,Color,size,tag--->
                        <div class="row mb-3">
                            <!-- Unit -->
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="unit" class=" col-form-label">Unit Name</label>
                                <div class="dropdown searchable-dropdown">
                                    <input type="text" id="search-input-unit" class="form-control"
                                        placeholder="Select Unit" data-toggle="dropdown" readonly>
                                    <div class="dropdown-menu" aria-labelledby="search-input-unit">
                                        <input type="text" id="option-search-input-unit" class="form-control"
                                            placeholder="Search...">
                                        @foreach ($units as $unit)
                                            <a class="dropdown-item"
                                                data-id="{{ $unit->id }}">{{ $unit->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="text-danger">
                                    @error('unit_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                                <input type="hidden" name="unit_id" id="unit-id">
                            </div>
                            <!-- Color -->
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="name" class=" col-form-label">Color Name</label>
                                <select class="color js-states form-control px-1" name="color[]" multiple="multiple">
                                    @foreach ($product->colors as $singleColor)
                                        <option value="{{ $singleColor->color_id }}" selected>
                                            {{ $singleColor->color->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('color')
                                        {{ $message }}
                                    @enderror
                                </div>

                            </div>
                            <!-- Size -->
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="name" class=" col-form-label">Size Name</label>
                                <select class="size js-states form-control px-1" name="size[]"
                                    placeholder="select Size " multiple="multiple">
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}"
                                            @foreach ($product->sizes as $singleSize) @selected($size->id == $singleSize->size_id) @endforeach>
                                            {{ $size->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('size')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <!-- Tag -->
                            <div class="form-group col-12 col-md-6 col-lg-3">
                                <label for="name" class="col-form-label">Tag Name</label>
                                <select class="tag js-states form-control px-1" name="tag[]" placeholder="select Size "
                                    multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                            @foreach ($product->tag as $singleTag) @selected($tag->id == $singleTag->tag_id) @endforeach>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('tag')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--//Unit,Color,size,tag--->

                        <!--name,code,type--->
                        <div class="row mb-3">
                            <!-- Product name -->
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="name" class=" col-form-label">Product Name</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                                    placeholder="Product Name">
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <!-- Code -->
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="name" class=" col-form-label">Product Code</label>
                                <input type="text" name="code" value="{{ $product->code }}" class="form-control"
                                    placeholder="Product Code">
                                <div class="text-danger">
                                    @error('code')
                                        {{ $message }}
                                    @enderror
                                </div>

                            </div>
                            <!-- Type -->
                            <div class="form-group col-12 col-md-6 col-lg-4">
                                <label for="name" class=" col-form-label">Product Type</label>
                                <select class="form-control" name="type">
                                    <option disabled selected>Select product type</option>
                                    <option value="1" {{ $product->type == 1 ? 'selected' : '' }}> Hot
                                    </option>
                                    <option value="2" {{ $product->type == 2 ? 'selected' : '' }}> Latest
                                    </option>
                                    <option value="3" {{ $product->type == 3 ? 'selected' : '' }}> Popular
                                    </option>
                                    <option value="4" {{ $product->type == 4 ? 'selected' : '' }}> Recommendation for you
                                    </option>
                                    <option value="5" {{ $product->type == 5 ? 'selected' : '' }}> DealPrime picks
                                    </option>
                                    <option value="6" {{ $product->type == 6 ? 'selected' : '' }}> Feature
                                    </option>
                                    <option value="7" {{ $product->type == 7 ? 'selected' : '' }}> Seasonal Favourite
                                    </option>
                                </select>
                                <div class="text-danger"> @error('type')
                                        {{ $message }}
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <!--//name,code,type--->

                        <!-- product price  -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label"> Product Price </label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" value="{{ $product->regular_price }}" class="form-control"
                                            name="regular_price" id="regular_price" placeholder="Regular Price "
                                            onkeyup="discountAmount()">
                                        <div class="text-danger">
                                            @error('regular_price')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" disabled="disabled"
                                            value="{{ $product->selling_price }}" name="selling_price"
                                            id="selling_price" placeholder="Selling Price ">
                                        <div class="text-danger">
                                            @error('selling_price')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Discount  -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label"> Product Discount </label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-6">
                                        <select class="form-select" name="discount_type" id="discount_type"
                                            onchange="discountType()">
                                            <option value="0" {{ $product->discount_type == '0' ? 'selected' : '' }}>Select
                                                Discount Type</option>
                                            <option value="percentage"
                                                {{ $product->discount_type == 'percentage' ? 'selected' : '' }}>Percentage
                                            </option>
                                            <option value="flat"
                                                {{ $product->discount_type == 'flat' ? 'selected' : '' }}>Flat</option>
                                        </select>
                                        <div class="text-danger">
                                            @error('discount_type')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control"
                                            value="{{ $product->discount_amount }}" onkeyup="discountAmount()"
                                            name="discount_amount" id="discount_amount" placeholder="Discount Amount" />
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
                                <input type="text" name="stock_amount" value="{{ $product->stock_amount }}"
                                    class="form-control" placeholder="Stock Amount ">
                                <div class="text-danger">
                                    @error('stock_amount')
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
                                    class="form-control">{!! $product->short_description !!}</textarea>
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
                                    class="form-control"> {!! $product->long_description !!}</textarea>
                                <div class="text-danger">
                                    @error('long_description')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Product image, other-image -->
                        <div class="row mb-3">
                            <!--product image-->
                            <div class="form-group col-12 col-md-6 col-lg-6">
                                <label for="product_image" class="col col-form-label">Product Image </label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                <small class="form-text text-muted">Image size should be 300x300 pixels.</small>
                                <div class="text-danger">@error('image'){{ $message }}@enderror</div>
                                <small id="errorMessage" class="form-text text-danger"></small>
                                <div id="image-preview" style="margin-top: 5px;">
                                    @if ($product->image)
                                        <img src="{{ asset($product->image) }}" alt="Product Image"
                                            style="max-width: 90px; max-width:90px;">
                                    @endif
                                </div>
                                <div class="text-danger">
                                    @error('image')
                                        {{ $message }}
                                    @enderror
                                </div>

                            </div>
                            <!--product Other image-->
                            <div class="form-group col-12 col-md-6 col-lg-6">
                                <label for="other_image" class="col col-form-label">Other Image</label>
                                <input type="file" id="other_image" name="other_image[]" multiple class="form-control" >
                                <small class="form-text text-muted">Image size should be 500x500 pixels.</small>
                                <div class="form-text text-danger" id="multipleImgError"></div>
                                <div class="text-danger"> @error('other_image'){{ $message }}@enderror</div>
                                <div class="row mt-1" id="multipleImagePreview">
                                    @foreach ($product->productImages as $productImage)
                                        <div class="col-md-2 mb-1">
                                            <img src="{{ asset($productImage->image) }}" alt="" class="mt-1"
                                                style="max-width: 70px; max-height:70px;" />
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <!-- //Product image, other-image -->
                        <div class="row mb-3">
                            <!-- Others Image One -->
                            <div class="col-md-3">
                                <label for="image" class="col-md-12 col-form-label">Others Image One </label>
                                <input type="file" name="image_one" id="image_one" class="form-control">
                                <small class="form-text text-muted">Image size should be 500x500 pixels.</small>
                                <div class="text-danger" id="error-message-one"></div>
                                <div id="image-preview-one" style="margin-top: 10px;">
                                    <img src="{{ asset($product->image_one) }}"
                                         style="width: 100%; height: 120px; border: 1px solid #ccc; padding: 5px;">
                                </div>
                                <div class="text-danger">
                                    @error('image_one')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <!--Others Image two-->
                            <div class="col-md-3">
                                <label for="image" class="col-md-12 col-form-label">Others Image Two </label>
                                <input type="file" name="image_two" id="image_two" class="form-control">
                                <small class="form-text text-muted">Image size should be 500x500 pixels.</small>
                                <div class="text-danger" id="error-message-two"></div>
                                <div id="image-preview-two" style="margin-top: 10px;">
                                    <img src="{{ asset($product->image_two) }}"
                                         style="width: 100%; height: 120px; border: 1px solid #ccc; padding: 5px;">

                                </div>
                                <div class="text-danger">
                                    @error('image_two')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <!--Others Image three-->
                            <div class="col-md-3">
                                <label for="image" class="col-md-12 col-form-label">Others Image Three </label>
                                <input type="file" name="image_three" id="image_three" class="form-control">
                                <small class="form-text text-muted">Image size should be 500x500 pixels.</small>
                                <div class="text-danger" id="error-message-three"></div>
                                <div id="image-preview-three" style="margin-top: 10px;">
                                    <img src="{{ asset($product->image_three) }}"
                                        style="width: 100%; height: 120px; border: 1px solid #ccc; padding: 5px;">
                                </div>
                                <div class="text-danger">
                                    @error('image_three')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <!--Others Image four-->
                            <div class="col-md-3">
                                <label for="image" class="col-md-12 col-form-label">Others Image Four </label>
                                <input type="file" name="image_four" id="image_four" class="form-control">
                                <small class="form-text text-muted">Image size should be 500x500 pixels.</small>
                                <div class="text-danger" id="error-message-four"></div>
                                <div id="image-preview-four" style="margin-top: 10px;">
                                    <img src="{{ asset($product->image_four) }}"
                                        style="width: 100%; height: 120px; border: 1px solid #ccc; padding: 5px;">
                                </div>
                                <div class="text-danger">
                                    @error('image_four')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--heading-->
                        <div class="row mb-3">
                            <div class="col-12 col-md-12">
                                <article>
                                    <button type="button" class="add btn btn-primary btn-sm  permission_set "
                                        data-toggle="modal" data-id="" style="margin-bottom: 5px">Add</button>


                                    <table class="table table-responsive table-striped table-bordered ">
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
                                <label for="advance_pay1" class="col-md-12 pt-0 col-form-label">Advance Payment</label><br>
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" name="advance_pay"
                                           id="advance_pay1" {{ $product->advance_pay == 1 ? 'checked' : '' }} onclick="togglePaymentField()">
                                    <label class="form-check-label" for="advance_pay1">
                                        Yes
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input"  type="radio" value="0" name="advance_pay"
                                           id="advance_pay2"  {{ $product->advance_pay == 0 ? 'checked' : '' }} onclick="togglePaymentField()">
                                    <label class="form-check-label" for="advance_pay2">
                                        No
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6" id="paymentField" style="display: none;">
                                <label for="payment_amount" class="col-form-label p-0">Advance Amount</label>
                                <input type="number" class="form-control" id="payment_amount" name="advance_pay_amount" placeholder="Enter amount"
                                       value="{{ old('advance_pay_amount', $product->advance_pay_amount ?? 0 ) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="flasSale1" class="col-md-12 pt-0 col-form-label">Flash Sale</label>
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" name="flash_sale"
                                           id="flasSale1" {{ $product->flash_sale == 1 ? 'checked' : '' }} >
                                    <label class="form-check-label" for="flasSale1">
                                        On
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input"  type="radio" value="0" name="flash_sale"
                                           id="flasSale2"  {{ $product->flash_sale == 0 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flasSale2">
                                        Off
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="description" class="col-md-12 pt-0 col-form-label">Status</label>
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{ $product->status == 1 ? 'checked' : '' }}
                                    type="radio" value="1" name="status" checked id="status1">
                                    <label class="form-check-label" for="status">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{ $product->status == 0 ? 'checked' : '' }}
                                    type="radio" value="0" name="status" id="status2">
                                    <label class="form-check-label" for="status">
                                        Unpublished
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-info">Update product</button>
                            </div>
                        </div>
                        
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    @include('admin.layouts.text-editor')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categories = @json($categories);
            const subCategories = @json($SubCategories);
            const brands = @json($brands);
            const units = @json($units);
            const subSubcategories = @json($SubSubcategories);

            const selectedCategoryId = {{ $product->category_id ?? 'null' }};
            const selectedSubCategoryId = {{ $product->sub_category_id ?? 'null' }};
            const selectedBrandId = {{ $product->brand_id ?? 'null' }};
            const selectedUnitId = {{ $product->unit_id ?? 'null' }};
            const selectedSubSubCategoryId = {{ $product->sub_subcategory_id ?? 'null' }};

            // Function to set value or empty string if not found
            const setValue = (elementId, hiddenInputId, items, id) => {
                const element = document.getElementById(elementId);
                const hiddenInput = document.getElementById(hiddenInputId);
                const foundItem = items.find(item => item.id === id);
                if (foundItem) {
                    element.value = foundItem.name;
                    hiddenInput.value = foundItem.id;
                } else {
                    element.value = '';
                    hiddenInput.value = '';
                }
            };

            // Set values for categories, subcategories, brands, units, and sub-subcategories
            setValue('search-input-category', 'category-id', categories, selectedCategoryId);
            setValue('search-input-sub_category', 'sub-category-id', subCategories, selectedSubCategoryId);
            setValue('search-input-brand', 'brand-id', brands, selectedBrandId);
            setValue('search-input-unit', 'unit-id', units, selectedUnitId);
            setValue('search-input-sub_subcategory', 'sub-subcategory-id', subSubcategories,
                selectedSubSubCategoryId);

            // Populate the sub-subcategory list
            const subsubcategoryList = document.getElementById('subsubcategory-list');
            subSubcategories.forEach(subSubcategory => {
                const item = document.createElement('a');
                item.classList.add('dropdown-item');
                item.textContent = subSubcategory.name;
                item.setAttribute('data-value', subSubcategory.id);
                subsubcategoryList.appendChild(item);

                item.addEventListener('click', function() {
                    document.getElementById('search-input-sub_subcategory').value = subSubcategory
                        .name;
                    document.getElementById('sub-subcategory-id').value = subSubcategory.id;
                });
            });

            // Ensure selected sub-subcategory is highlighted
            const selectedSubSubCategory = subSubcategories.find(subSubcategory => subSubcategory.id ===
                selectedSubSubCategoryId);
            if (selectedSubSubCategory) {
                document.getElementById('search-input-sub_subcategory').value = selectedSubSubCategory.name;
                document.getElementById('sub-subcategory-id').value = selectedSubSubCategory.id;
            }

            // Add event listeners for category selection
            document.querySelectorAll('.category-item').forEach(item => {
                item.addEventListener('click', function() {
                    const categoryId = this.getAttribute('data-id');
                    const categoryName = this.textContent;
                    document.getElementById('search-input-category').value = categoryName;
                    document.getElementById('category-id').value = categoryId;

                    // Clear subcategory and sub-subcategory selections
                    document.getElementById('search-input-sub_category').value = '';
                    document.getElementById('sub-category-id').value = '';
                    document.getElementById('search-input-sub_subcategory').value = '';
                    document.getElementById('sub-subcategory-id').value = '';

                    // Load subcategories based on selected category
                    fetch(`/get-subcategories/${categoryId}`)
                        .then(response => response.json())
                        .then(data => {
                            const subcategoryList = document.getElementById('subcategory-list');
                            subcategoryList.innerHTML = '';
                            data.forEach(subcategory => {
                                const subItem = document.createElement('a');
                                subItem.classList.add('dropdown-item');
                                subItem.textContent = subcategory.name;
                                subItem.setAttribute('data-value', subcategory.id);
                                subcategoryList.appendChild(subItem);

                                subItem.addEventListener('click', function() {
                                    document.getElementById(
                                            'search-input-sub_category').value =
                                        subcategory.name;
                                    document.getElementById('sub-category-id')
                                        .value = subcategory.id;

                                    // Clear sub-subcategory selection
                                    document.getElementById(
                                            'search-input-sub_subcategory')
                                        .value = '';
                                    document.getElementById(
                                        'sub-subcategory-id').value = '';

                                    // Load sub-subcategories based on selected subcategory
                                    fetch(
                                            `/get-subsubcategories/${subcategory.id}`
                                        )
                                        .then(response => response.json())
                                        .then(data => {
                                            const subsubcategoryList =
                                                document.getElementById(
                                                    'subsubcategory-list');
                                            subsubcategoryList.innerHTML =
                                                '';
                                            data.forEach(subsubcategory => {
                                                const subSubItem =
                                                    document
                                                    .createElement(
                                                        'a');
                                                subSubItem.classList
                                                    .add(
                                                        'dropdown-item'
                                                    );
                                                subSubItem
                                                    .textContent =
                                                    subsubcategory
                                                    .name;
                                                subSubItem
                                                    .setAttribute(
                                                        'data-value',
                                                        subsubcategory
                                                        .id);
                                                subsubcategoryList
                                                    .appendChild(
                                                        subSubItem);

                                                subSubItem
                                                    .addEventListener(
                                                        'click',
                                                        function() {
                                                            document
                                                                .getElementById(
                                                                    'search-input-sub_subcategory'
                                                                )
                                                                .value =
                                                                subsubcategory
                                                                .name;
                                                            document
                                                                .getElementById(
                                                                    'sub-subcategory-id'
                                                                )
                                                                .value =
                                                                subsubcategory
                                                                .id;
                                                        });
                                            });
                                        });
                                });
                            });
                        });
                });
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
                    url:"{{ url('get-subcategories') }}/" + categoryId,
                    // url: '/get-subcategories/' + categoryId,
                    type: 'GET',
                    success: function(response) {
                        let subcategories = response.subcategories;
                        console.log(subcategories)
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

                                    url:"{{ url('get-subsubcategories') }}/" + subcategoryId,

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
                                                    $('#search-input-sub_subcategory')
                                                        .dropdown(
                                                            'toggle');
                                                });
                                        }
                                    }
                                });
                                $('.dropdown-menu').hide();

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
            });;
            // =====================add Product compare============.
            var data_id = $("#productId").val();
            $.ajax({
                url: "{{ url('product-comperison') }}/" + data_id,
                type: 'GET',
                success: function(response) {
                    // console.log(response.productCompare)
                    $.each(response.productCompare, function(i, val) {
                        var item_list = '<tr class="in_tr">';
                        item_list += '<td style="width: 45%;padding: 5px"  >';
                        item_list +=
                            '<input type="text" class="form-control key_name w-100 w-md-100"  name="key_name[]" value="' +
                            val.key_name + '"  style="width: 200px" />';
                        item_list += '</td>';
                        item_list += '<td style="width: 45%;padding: 5px">';
                        item_list +=
                            '<input type="text" class="form-control key_value w-100  w-md-100" step="any"  name="key_value[]" value="' +
                            val.key_value + '"  />';
                        item_list += '</td>';
                        item_list += '<td style="width: 10%;padding: 5px">';
                        item_list +=
                            '<button type="button" class="cut btn btn-danger btn-sm w-20" data-toggle="modal" data-target="" data-id="">Delete</button>';
                        item_list += '</td>';
                        item_list += '</tr>';

                        $('.inventory').append(item_list);
                    });
                }
            });

            $(document).on('click', '.add , .newb', function() {
                var item_list = '<tr class="in_tr">';
                item_list += '<td style="width: 45%"  >';
                item_list +=
                    '<input type="text" class="form-control key_name w-100 w-md-100"  name="key_name[]" value="" style="width: 200px" />';
                item_list += '</td>';
                item_list += '<td style="width: 45%">';
                item_list +=
                    '<input type="text" class="form-control key_value w-100  w-md-100" step="any"  name="key_value[]" value="" />';
                item_list += '</td>';
                item_list += '<td style="width: 10%">';
                item_list +=
                    '<button type="button" class="cut btn btn-danger btn-sm w-100" data-toggle="modal" data-target="" data-id="">Delete</button>';
                item_list += '</td>';
                item_list += '</tr>';

                $('.inventory').append(item_list);
            });

            $(document).on('click', '.cut', function() {
                var thisElement = $(this);
                thisElement.parents('tr.in_tr').remove();

            });

        });
    </script>

    <script>
        function discountAmount() {
            let discount_amount = $('#discount_amount').val();
            let discountType = $('#discount_type').val();
            let regular_price = parseFloat($('#regular_price').val());

            let selling_price = '';

            if (discountType === 'percentage') {
                selling_price = regular_price - (regular_price * discount_amount / 100);
            } else if (discountType === 'flat') {
                selling_price = regular_price - parseFloat(discount_amount);
            } else {
                $('#selling_price').val('');
                return;
            }

            $('#selling_price').val(selling_price);
        }
    </script>


    <script>
        $(document).ready(function() {
            // Initialize Select2 for the color dropdown
            $('.color').select2({
                placeholder: "Select Color",
                allowClear: true,
            });

            // Event listener for category selection
            $('.category-item').on('click', function(e) {
                e.preventDefault();
                let categoryId = $(this).data('id');
                let categoryName = $(this).text().trim();

                // Update category input fields
                $('#search-input-category').val(categoryName);
                $('#category-id').val(categoryId);

                // Clear dependent fields and lists
                $('#search-input-sub_category, #search-input-sub_subcategory').val('');
                $('#sub-category-id, #sub_subcategory-id').val('');
                $('#subcategory-list, #subsubcategory-list').empty();

                // Fetch colors based on the selected category
                $.ajax({
                    url: `{{ url('get-colors') }}/${categoryId}`,
                    type: 'GET',
                    success: function(response) {
                        let colors = response.colors;

                        // Clear the existing options in the color dropdown
                        $('.color').empty();

                        if (colors.length > 0) {
                            colors.forEach(function(color) {
                                $('.color').append(
                                    `<option value="${color.id}">${color.name}</option>`
                                );
                            });
                        } else {
                            $('.color').append('<option value="">No colors available</option>');
                        }
                    },
                    error: function() {
                        alert('Error fetching colors. Please try again.');
                    },
                });
            });
        });
    </script>

   <!-- nayem 02-01-25 -->
    {{-- image --}}
    <script>

        $(document).ready(function () {
            $('#other_image').on('change', function (e) {
                // Clear previous error messages and previews
                $('#multipleImgError').text('');
                $('#multipleImagePreview').html('');
                //***** For maximum file upload range
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
    <!-- /nayem 02-01-25 -->
      <script>
        function togglePaymentField() {
            var paymentField = document.getElementById("paymentField");
            var paymentInput = document.getElementById("payment_amount");
            var advancePayYes = document.getElementById("advance_pay1").checked;

            if (advancePayYes) {
                paymentField.style.display = "block";
            } else {
                paymentField.style.display = "none";
                paymentInput.value = 0; // No সিলেক্ট করলে ফিল্ড ক্লিয়ার হবে
            }
        }

        // পেজ লোড হওয়ার সময় চেক করবে Yes সিলেক্ট করা আছে কিনা
        window.onload = function () {
            togglePaymentField();
        };
    </script>

@endsection
