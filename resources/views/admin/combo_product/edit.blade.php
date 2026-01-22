@extends('admin.layouts.master')

@section('title')
    Combo Product Edit
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('combo_product.index') }}">Combo Product Manage</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Combo Product Edit</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Combo Product Module</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Combo Product Form</h4>

                    <form class="form-horizontal" action="{{ route('combo_product.update', $combo->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Image Upload -->
                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label">Combo Product Image</label>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="imageInput" name="image">
                                    <div class="text-danger">@error('image'){{ $message }}@enderror</div>
                                    <div id="error-message" style="color: red;"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <img id="imagePreview" src="{{ asset($combo->image) }}" alt="Your Image" class="img-fluid"
                                    style="display:{{ $combo->image ? 'block' : 'none' }}" />
                            </div>
                        </div>
                        @if (Auth::user()->role == 'Admin')
                            <div class="row mb-3">
                                <label for="merchant_id" class="col-md-3 col-form-label">Merchant Select</label>
                                <div class="col-md-9">
                                    <select class="form-select " name="merchant_id">
                                        <option disabled>Please Select Merchent </option>
                                        @if ($merchants->count() > 0)
                                            @foreach ($merchants as $merchant)
                                                <option
                                                    value="{{ $merchant->id }}"{{ $merchant->id == $combo->merchant_id ? 'selected' : '' }}>
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

                        <!-- Combo product name -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Combo product name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{ old('name', $combo->name) }}"
                                    name="name" id="name" placeholder="Combo product name" />
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="code" class="col-md-3 col-form-label">Combo product Code</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{ old('code', $combo->code) }}"
                                    name="code" id="code" placeholder="Combo product code" />
                                <div class="text-danger">
                                    @error('code')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Select Products -->
                        <div class="row mb-3">
                            <label for="product_id" class="col-md-3 col-form-label">Select Combo Products</label>
                            <div class="col-md-9">
                                <select class="combo_product form-control px-1" name="product_id[]" multiple="multiple">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->selling_price }}"
                                            @if (in_array($product->id, $combo->comboDetails->pluck('product_id')->toArray())) selected @endif>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('product_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Regular Price -->
                        <div class="row mb-3">
                            <label for="regular_price" class="col-md-3 col-form-label">Combo Regular Price</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" disabled
                                    value="{{ old('regular_price_display', '') }}" id="regular_price"
                                    placeholder="Regular Price" />
                                <input type="hidden" class="form-control"
                                    value="{{ old('regular_price', $combo->regular_price) }}" name="regular_price"
                                    id="hidden_regular_price" />
                                <div class="text-danger">
                                    @error('regular_price')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Discount Type -->
                        <div class="row mb-3">
                            <label for="discount_type" class="col-md-3 col-form-label">Combo Discount Type</label>
                            <div class="col-md-9">
                                <select class="form-select" name="discount_type">
                                    <option disabled>Select Discount Type</option>
                                    <option value="percentage"
                                        {{ old('discount_type', $combo->discount_type) == 'percentage' ? 'selected' : '' }}>
                                        Percentage Discount</option>
                                    <option value="flat"
                                        {{ old('discount_type', $combo->discount_type) == 'flat' ? 'selected' : '' }}>Flat
                                        Discount</option>
                                </select>
                                <div class="text-danger">
                                    @error('discount_type')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Discount Amount -->
                        <div class="row mb-3">
                            <label for="discount_amount" class="col-md-3 col-form-label">Discount Amount</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"
                                    value="{{ old('discount_amount', $combo->discount_amount) }}" name="discount_amount"
                                    id="discount_amount" placeholder="Discount Amount" />
                                <div class="text-danger">
                                    @error('discount_amount')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stock_amount" class="col-md-3 col-form-label"> Stock  Amount</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" value="{{$combo->stock_amount}}" name="stock_amount" id="stock_amount" placeholder="stock Amount"/>
                            <div class="text-danger">@error('stock_amount'){{$message}} @enderror</div>
                            </div>
                        </div>

                        <!-- Short Description -->
                        <div class="row mb-3">
                            <label for="short_description" class="col-md-3 col-form-label">Short Description</label>
                            <div class="col-md-9">
                                <textarea name="short_description" class="form-control" id="short_description" placeholder="Short Description"
                                    cols="4" rows="4">{{ old('short_description', $combo->short_description) }}</textarea>
                                <div class="text-danger">
                                    @error('short_description')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="long_description" class="col-md-3 col-form-label"> Long Description</label>
                            <div class="col-md-9">
                                <textarea name="long_description"  class="form-control"id="summernote" placeholder="Long Description" cols="4" rows="4">{!!$combo->long_description!!}</textarea>
                            <div class="text-danger">@error('long_description'){{$message}} @enderror</div>
                            </div>
                        </div>

                        <!-- Publication Status -->
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="1" name="status"
                                        {{ old('status', $combo->status) == 1 ? 'checked' : '' }} id="status1">
                                    <label class="form-check-label" for="status1">Published</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="0" name="status"
                                        {{ old('status', $combo->status) == 0 ? 'checked' : '' }} id="status2">
                                    <label class="form-check-label" for="status2">Unpublished</label>
                                </div>
                                <div class="text-danger">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Update Combo Product</button>
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
            function calculateRegularPrice() {
                let totalPrice = 0;
                let priceList = [];

                $('.combo_product option:selected').each(function() {
                    let price = parseFloat($(this).data('price')) || 0;
                    priceList.push(price);
                    totalPrice += price;
                });

                let priceString = priceList.join(' + ') + (priceList.length > 0 ? ' = ' : '') + totalPrice;
                $('#regular_price').val(priceString);
                $('#hidden_regular_price').val(totalPrice);
            }

            // Initial calculation on page load
            calculateRegularPrice();

            // Recalculate when selection changes
            $('.combo_product').on('change', function() {
                calculateRegularPrice();
            });
        });


        $(document).ready(function () {
            $('#imageInput').change(function () {
                let file = this.files[0];
                let errorMessage = $('#error-message');
                let imagePreview = $('#imagePreview');

                // Reset error message and image preview
                errorMessage.text('');
                imagePreview.attr('src', '#');

                if (file) {
                    // Validate file size (2MB = 2 * 1024 * 1024 bytes)
                    if (file.size > 2 * 1024 * 1024) {
                        errorMessage.text('File size must not exceed 2MB.');
                        return;
                    }

                    // Validate image resolution
                    let img = new Image();
                    img.onload = function () {
                        if (this.width > 1920 || this.height > 1080) {
                            errorMessage.text('Image dimensions should not exceed 1920x1080 pixels.');
                        } else {
                            // Display image preview
                            imagePreview.attr('src', URL.createObjectURL(file));
                        }
                    };
                    img.onerror = function () {
                        errorMessage.text('Invalid image file.');
                    };
                    img.src = URL.createObjectURL(file);
                }
            });

            $('#uploadForm').submit(function (e) {
                // Prevent form submission if there's an error
                if ($('#error-message').text() !== '') {
                    e.preventDefault();
                }
            });
    });


    </script>
@endsection
