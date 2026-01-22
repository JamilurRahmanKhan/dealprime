@extends('website.layouts.master')
@section('title', 'Checkout')
@section('body')
    <main class="main main-test">
        <div class="container checkout-container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li>
                    <a href="{{ route('carts.index') }}">Shopping Cart</a>
                </li>
                <li class="active">
                    <a href="{{ route('checkout') }}">Checkout</a>
                </li>
                <li class="disabled">
                    <a href="#">Order Complete</a>
                </li>
            </ul>
            @if($products->count() > 0)
            <!--Select shipping row-->
            <div class="row my-3">
                    <div class="col-lg-7">
                        <div class="col-lg-12">
                            <h3>Select Shipping Address</h3>

                            <div class="row">
                                @if ($deliveryAddress->count())
                                @foreach ($deliveryAddress as $index => $address)
                                <!-- Address Card -->
                                <div class="col-md-6 col-12 mb-1">
                                    <div class="card mb-0">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="mb-0">
                                                <div class="custom-control custom-radio mt-1">
                                                    <input type="radio" id="address-{{$address->id}}" name="shipping_address"
                                                           class="custom-control-input address-radio"
                                                           value="{{$address->id}}"
                                                           data-name="{{$address->name}}"
                                                           data-email="{{$address->email}}"
                                                           data-phone="{{$address->phone}}"
                                                           data-postcode="{{$address->zip_code}}"
                                                           data-address="{{$address->delivery_address}}"
                                                           {{ $loop->first ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="address-{{$address->id}}">
                                                        Delivery Address <span class="badge bg-warning p-3 text-dark">{{$index +1}}</span>
                                                    </label>
                                                </div>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div>Please go to customer  and store delivery address for continune checkout.
                                <div class="my-2"><a href="{{route('customer.dashboard')}}"><button class="btn btn-info btn-sm">Go Dashboard</button></a></div>
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    <!-- coupon   -->
                <div class="col-lg-5">
                    <div class="checkout-discount">
                            <div class="feature-box mb-1">
                                <div class="feature-box-content">
                                    <p>If you have a coupon code, please apply it below.</p>
                                    @if (!Session::get('coupon'))
                                        <form action="{{ route('get.coupon') }}" method="post">
                                            @csrf
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm w-auto"
                                                    name="coupon_code" value="{{ old('coupon_code') }}"
                                                    placeholder="Coupon code" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm mt-0" type="submit" style="background:#8BCA9B ">
                                                        Apply Coupon
                                                    </button>
                                                </div>
                                            </div>
                                             <input type="hidden" id="shipping_cost_n" name="shipping_cost"  value="">
                                        </form>
                                    @else
                                        <form action="{{ route('remove.coupon') }}" method="post">
                                            @csrf
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm w-auto"
                                                    name="coupon_code"
                                                    value="{{ Session::get('coupon')['code'] }} Coupon Applied"
                                                    placeholder="Coupon code" />
                                                <div class="input-group-append">
                                                    <!--<button class="btn btn-sm  mt-0" type="submit">-->
                                                    <!--    Remove Coupon-->
                                                    <!--</button>-->
                                                    <button class="btn btn-sm mt-0 btn-danger" type="submit" style="background:red">
                                                        Remove Coupon
                                                    </button>

                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                    
                                    <span>
                                     <span class="text-success">{{ Session::get('applied') }}</span>
                                    <span class="text-danger">
        
                                        {{ Session::get('error') }}
                                        @error('coupon_code')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </span>
                                </div>
                            </div>
                        {{-- </div> --}}
                        
                    </div>
                </div>
            </div>
            <form action="{{ route('new.order') }}" id="order_form" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <ul class="checkout-steps">
                            <li>
                                <h2 class="step-title my-3">Billing details</h2>

                                    <input type="hidden" name="order_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                    <input type="hidden" name="country" value="bangladesh">
                                    <input type="hidden" name="customer_id" value="{{Auth::guard('customer')->user()->id}}">

                                   <!-- Checkout Form -->
                                    <div class="form-group">
                                        <label>Full name <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="name" id="name" class="form-control" />
                                        <span class="text-danger" id="name-error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="text" name="email" id="email" class="form-control" />
                                        <span class="text-danger" id="email-error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label>Phone <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="phone" id="phone" class="form-control" />
                                        <span class="text-danger" id="phone-error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label>Postcode / Zip <abbr class="required" title="required">*</abbr></label>
                                        <input type="text" name="post_code" id="post_code" class="form-control" />
                                        <span class="text-danger" id="post_code-error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="order-comments">Delivery Address</label>
                                        <textarea class="form-control" name="delivery_address" id="delivery_address" placeholder="Delivery Address"></textarea>
                                        <span class="text-danger" id="delivery_address-error"></span>
                                    </div>

                            </li>
                        </ul>
                    </div>
                    <!-- End .col-lg-8 -->

                    <div class="col-lg-5">

                        <div class="order-summary">

                            <h3 class="mt-2">YOUR ORDER</h3>
                            <table class="table table-mini-cart">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sum=0 @endphp
                                    @foreach ($products as $product)
                                        <input type="hidden" name="merchant_id[]" value="{{ $product->options->merchant_id }}">
                                        <input type="hidden" name="product_id[]" value="{{$product->id}}">
{{--                                        <input type="hidden" name="combo_product_id[]" value="{{ $product->options->combo_p_id }}">--}}
{{--                                        <input type="hidden" name="product_discount[]" value="{{ $product->options->product_discount }}">--}}
                                        <input type="hidden" name="type[]" value="{{$product->options->type }}">
                                        <input type="hidden" name="qty[]" value="{{ $product->qty }}">
                                        <input type="hidden" name="price[]" value="{{ $product->price }}">
                                        <input type="hidden" name="regular_price[]" value="{{ $product->options->regular_price }}">
                                        <input type="hidden" name="color[]" value="{{ $product->options->color }}">
{{--                                        <input type="hidden" name="combo_product[]" value="{{ $product->options->size }}">--}}
                                        <input type="hidden" name="size[]" value="{{ $product->options->size }}">
                                        <tr>
                                            <td class="product-col">
                                                <h3 class="product-title">
                                                    {{ $product->name }} ×
                                                    <span class="product-qty">{{ $product->qty }}</span>
                                                </h3>
                                            </td>
                                            <td class="price-col">
                                                <span>{{ number_format($product->price) }} tk</span>
                                            </td>
                                            @php
                                                $total_price = $product->qty * $product->price;
                                            @endphp
                                            <td class="price-col">
                                                <span>{{ number_format($total_price) }} tk</span>
                                            </td>
                                        </tr>
                                        @php $sum=$sum+$total_price @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <td>
                                            <h4>Subtotal</h4>
                                        </td>

                                        <td colspan="3" class="price-col">
                                            <span>{{ number_format($sub_total = $sum) }} tk</span>
                                        </td>
                                    </tr>
                                    @if (!Session::get('coupon'))
{{--                                        <tr class="cart-subtotal">--}}
{{--                                            <td>--}}
{{--                                                <h4>Tax [15%]</h4>--}}
{{--                                            </td>--}}
{{--                                            <td colspan="3" class="price-col">--}}
{{--                                                <span>{{ number_format($tax = round($sum * 0.15)) }} tk</span>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
                                        <tr class="cart-subtotal">
                                            <td>
                                                <div class="mb-3">
                                                    <label id="colorText" for="delivery-location" class="form-label fw-bold">
                                                        <b>Please choose your delivery location</b>
                                                    </label>

                                                    <!--<label style="color: #000;" for="delivery-location" class="form-label fw-bold"><b>Please choose your delivery location </b></label>-->
                                                    <select required name="delivery_location" id="delivery-location" class="form-control form-control-sm" style="width: 70%">
                                                   
                                                    @foreach ($deliveryLocations as $key => $location)
                                                        <option value="{{$location->location_name}}" data-cost="{{ $location->delivery_charge }}" {{ $key == 0 ? 'selected' : '' }}>
                                                           @if($location->location_name == 'inside_dhaka')
                                                            Inside Dhaka
                                                            @elseif($location->location_name == 'outside_dhaka')
                                                            Outside Dhaka
                                                            @elseif($location->location_name == 'outside_country')
                                                            Outside Country 
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span id="shipping-cost-display" style="color: #000;font-size: 13px">Delivery Time:  (Inside Dhaka 1 - 3 days & Outside Dhaka 1 - 7 days)</span>
                                                 
                                                </div>
                                            </td>

                                            <td colspan="3" class="price-col">
                                                <span class="shipping-cost-display">{{ $shippingCost=  number_format($deliveryLocations[0]->delivery_charge ?? 100) }} tk</span>
                                            </td>
                                        </tr>
                                        <tr class="order-total">
                                            <td>
                                                <h4>Total</h4>
                                            </td>
                                            <td colspan="3">
                                                <b class="total-price">
                                                    <span id="total-bill-display">
                                                        {{ number_format(round($sum + ($deliveryLocations[0]->delivery_charge ?? 100))) }}
                                                        tk</span></b>
                                            </td>
                                            <input type="hidden" id="total-bill" name="order_total" value="{{$total_bill= round($sum + ($deliveryLocations[0]->delivery_charge ?? 100)) }}">
                                        </tr>
{{--                                        <input type="hidden" name="tax_total" value="{{$tax}}">--}}
                                        <input type="hidden" id="shipping_cost" name="shipping_cost"  value="{{ $shippingCost}}">
                                        {{-- <input type="hidden" name="order_total" value="{{ $total_bill = $sum}} "> --}}
                                    @else
                                        <tr class="cart-subtotal">
                                            <td>
                                                <h4>
                                                    Coupon [{{ Session::get('coupon')['code'] }}]<br>

                                                </h4>

                                            </td>

                                            <td colspan="3" class="price-col">
                                                <span>
                                                    (-) @if (Session::get('coupon')['type'] == 'percentage')
                                                        {{ Session::get('coupon')['amount'] }}%
                                                    @elseif(Session::get('coupon')['type'] == 'fixed')
                                                        {{ Session::get('coupon')['amount'] }}tk
                                                    @endif
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <td>
                                                <h4>After Applying Coupon Subtotal</h4>
                                            </td>

                                            <td colspan="3" class="price-col">
                                                <span>{{ number_format(Session::get('coupon')['new_total']) }} tk</span>
                                            </td>
                                        </tr>
                                        {{-- <tr class="cart-subtotal">
                                            <td>
                                                <h4>Tax [15%]</h4>
                                            </td>

                                            <td colspan="3" class="price-col">
                                                <span>{{ number_format(Session::get('coupon')['tax']) }} tk</span>
                                            </td>
                                        </tr> --}}
{{--                                        <tr class="cart-subtotal">--}}
{{--                                            <td>--}}
{{--                                                <h4>Shipping</h4>--}}
{{--                                            </td>--}}

{{--                                            <td colspan="3" class="price-col">--}}
{{--                                                <span>{{ number_format(Session::get('coupon')['shippingCost']) }} tk</span>--}}
{{--                                            </td>--}}


{{--                                        </tr>--}}

                                        <tr class="cart-subtotal">
                                            <td>
                                                <div class="mb-3">
                                                    <label id="colorText" for="delivery-location" class="form-label fw-bold">
                                                        <b>Please choose your delivery location</b>
                                                    </label>

                                                    <!--<label style="color: #000;" for="delivery-location" class="form-label fw-bold"><b>Please choose your delivery location </b></label>-->
                                                    <select required name="delivery_location" id="delivery-location-cupon" class="form-control form-control-sm" style="width: 70%">
                                                   
                                                    @foreach ($deliveryLocations as $key => $location)
                                                        <option value="{{$location->location_name }}" data-cost-cupon="{{ $location->delivery_charge }}" {{ $key == 0 ? 'selected' : '' }}>
                                                            {{ $location->location_name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                
                                                <span id="shipping-cost-display-cupon" style="color: #000;font-size: 13px">Delivery Time:  (Inside Dhaka 1 - 3 days & Outside Dhaka 1 - 7 days)</span>
                                                 
                                                </div>
                                            </td>

                                            <td colspan="3" class="price-col">
                                                <span class="shipping-cost-display-cupon">{{ $shippingCost=  number_format($deliveryLocations[0]->delivery_charge ?? 100) }} tk</span>
                                                  
                                            </td>
                                        </tr>

                                        <!--<tr class="cart-subtotal">-->
                                        <!--    <td>-->
                                        <!--        <div class="mb-3">-->
                                        <!--            <label for="delivery-location-cupon" class="form-label fw-bold"><b>Please choose your delivery location </b></label>-->
                                        <!--            <select name="delivery_location" id="delivery-location-cupon" class="form-control form-control-sm" style="width: 70%">-->
                                        <!--                @foreach ($deliveryLocations as $key => $location)-->
                                        <!--                    <option value="{{ $location->location_name }}" data-cost-cupon="{{ $location->delivery_charge }}" {{ $key == 0 ? 'selected' : '' }}>-->
                                        <!--                        {{ $location->location_name }}-->
                                        <!--                    </option>-->
                                        <!--                @endforeach-->
                                        <!--            </select>-->
                                        <!--            {{--                                                <span id="shipping-cost-display">{{ number_format($shippingCost = 100) }} tk</span>--}}-->
                                                 
                                        <!--        </div>-->
                                        <!--    </td>-->

                                        <!--    <td colspan="3" class="price-col">-->
                                        <!--        <span class="shipping-cost-display-cupon">{{ $shippingCost = number_format($deliveryLocations[0]->delivery_charge ?? 100) }} tk</span>-->
                                        <!--    </td>-->
                                        <!--</tr>-->
                                        <tr class="order-total">
                                            <td>
                                                <h4>Total</h4>
                                            </td>

                                            <td colspan="3">
                                                <b class="total-price">
                                                    <span id="total-bill-display-cupon">
                                                        {{ number_format(round(Session::get('coupon')['new_total'] + ($deliveryLocations[0]->delivery_charge ?? 100))) }} tk
                                                    </span>
                                                </b>
{{--                                                <b class="total-price"><span>--}}
{{--                                                        {{ number_format(Session::get('coupon')['grand_total']) }}tk</span>--}}
{{--                                                </b>--}}
                                            </td>
                                        </tr>
                                        <input type="hidden" id="total-bill-cupon" name="order_total" value="{{$total_bill= round(Session::get('coupon')['new_total'] + ($deliveryLocations[0]->delivery_charge ?? 100)) }}">

                                        {{--                                        <input type="hidden" name="order_total" value="{{ Session::get('coupon')['grand_total'] }} ">--}}

                                        {{-- <input type="hidden" name="tax_total" value="{{Session::get('coupon')['tax']}}"> --}}
                                        <input type="hidden" id="shipping_cost_cupon" name="shipping_cost"  value="{{ $shippingCost}}">
{{--                                        <input type="hidden" name="shipping_cost" value="{{Session::get('coupon')['shippingCost'] }}">--}}
                                        @if (Session::get('coupon')['type'] == 'percentage')
                                        <input type="hidden" name="coupon_discount" value=" {{ Session::get('coupon')['amount'] }}%">
                                        @else
                                        <input type="hidden" name="coupon_discount" value=" {{ Session::get('coupon')['amount'] }} tk">
                                        @endif 

                                        <input type="hidden" name="coupon_discount_amount" value="{{ max(0, $sub_total - Session::get('coupon')['new_total']) }} ">
                                    @endif
                                </tfoot>
                            </table>


                            <div class="payment-methods mb-1">
                                <h4>Payment methods</h4>
                                @php
                                    $advancePaymentRequired = false;
                                    $advancePayAmount = 0;

                                    foreach (Cart::content() as $product) {
                                        if ($product->options->advance_pay == 1) {
                                            $advancePaymentRequired = true;
                                            $advancePayAmount += $product->options->advance_pay_amount;
                                        }
                                    }
                                @endphp
                                <!-- First Payment Method -->
                                @if($advancePaymentRequired)
                                    <div class="alert alert-warning mt-2">
                                        <strong>Please advance pay: {{ number_format($advancePayAmount, 2) }} TK</strong>.<br><br>
                                        <strong>Due amount COD: {{ number_format($total_bill-$advancePayAmount, 2) }} TK</strong>.
                                        <input type="hidden" name="advance_payment" value="{{ $advancePayAmount }}">
                                        <input type="hidden" name="total_bill" value="{{ $total_bill }}">
                                    </div>
                                @endif
                            <!-- COD Option (Only Show If Advance Payment Is Not Required) -->
                                @if(!$advancePaymentRequired)
                                    <div class="card mb-1" id="codSection">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <div class="custom-control custom-radio mt-1">
                                                    <input type="radio" id="cod" name="payment_method"
                                                           class="custom-control-input payment-checkbox" value="cod" checked>
                                                    <label class="custom-control-label" for="cod">Cash On Delivery</label>
                                                </div>
                                            </h5>
                                        </div>
                                    </div>
                                @endif

                                <!-- Second Payment Method -->
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <div class="custom-control custom-radio mt-1">
                                                <input type="radio" id="onlinePayment" name="payment_method"
                                                    class="custom-control-input payment-checkbox" value="online">
                                                <label class="custom-control-label" for="onlinePayment">Online Payment</label>
                                            </div> 
                                        </h5>
                                    </div>
                                </div>

                                @if($advancePaymentRequired)
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <div class="custom-control custom-radio mt-1">
                                                <input type="radio" id="onlinePayment" name="payment_method"
                                                    class="custom-control-input payment-checkbox" value="fullAmount">
                                                <label class="custom-control-label" for="onlinePayment">Pay Full Amount</label>
                                            </div>
                                             
                                        </h5>
                                    </div>
                                </div>
                                @endif
                                <b><span class="text-danger payment-method-error"></span></b>
                                <div class="d-flex justify-content-center gap-4 flex-wrap p-2">
                                    <input type="checkbox" id="terms" name="terms" value="1">&nbsp; I accept the &nbsp;
                                    <a href="{{route('termsType',['terms_type' => 1,'user_type' => 0])}}" target="_blank" >
                                        <b>Terms & Condition, </b>
                                    </a>
                                    
                                    <a href="{{route('termsType',['terms_type' => 2,'user_type' => 0])}}" target="_blank" >
                                      <b>&nbsp;  Return & Refund Policy, </b>
                                    </a>&nbsp; 
                                     
                                    <a href="{{route('termsType',['terms_type' => 3,'user_type' => 0])}}" target="_blank" >
                                       <b> Privacy Policy </b>
                                    </a>&nbsp; I agree to comply before placing my order.
                                </div>
                                 <div id="error-message" class="text-danger mt-2 fw-bold " style="display: none;"></div>
                            </div>
                            <input type="submit"   class="btn col-12 btn-dark" value="Place Order" />
                            <!--<button type="submit"  class="btn col-12 btn-dark">Place Order</button>-->
                        </div>
                        <!-- End .cart-summary -->
                    </div>
                    <!-- End .col-lg-4 -->
                </div>
            </form>
            <!-- End .row -->
            @else
            @php
            $advancePaymentRequired = false;
            $sum = 0;
            @endphp
            <!--=====  Shima  =====-->
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center align-items-center text-center" style="min-height: 5vh;">
                    <img src="{{ asset('/') }}website/assets/images/notfound/cart_empty.gif" alt="Cart Empty" width="300"  class="img-fluid">
                </div>
            </div> 
            @endif
        </div>
        <!-- End .container -->
    </main>
    <!-- End .main -->


    {{-- <script>
        function getPoliceStation(districtId) {
            if (districtId) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('get.policeStations') }}",
                    data: {
                        id: districtId
                    },
                    dataType: "JSON",
                    success: function(response) {
                        var policeStationId = $('#policeStationId');
                        policeStationId.empty();
                        policeStationId.append('<option value="">Select Police Station</option>');

                        if (response.length > 0) {
                            $.each(response, function(key, value) {
                                policeStationId.append('<option value="' + value.id + '">' + value
                                    .name + '</option>');
                            });
                        } else {
                            policeStationId.append('<option value="">No Police Stations Available</option>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            } else {
                $('#policeStationId').empty();
                $('#policeStationId').append('<option value="">Select Police Station</option>');
            }
        }
    </script> --}}

    <script>
     
    
    $(document).ready(function () {
    // Function to validate text fields
        function validateField(field, errorField, regex = null, errorMessage = "This field is required") {
            const value = $(field).val().trim();
            if (!value || (regex && !regex.test(value))) {
                $(errorField).text(errorMessage).show();
                return false;
            } else {
                $(errorField).text('').hide();
                return true;
            }
        }
    
        // // Function to validate payment checkbox
        function validatePaymentCheckbox() {
            if (!$('.payment-checkbox').is(':checked')) {
                $('.validation-error').text('Please check the Payment option before proceeding.').show();
                return false;
            } else {
                $('.validation-error').text('').hide();
                return true;
            }
        }
    
        // Function to validate radio buttons
        function validateRadioButton(name, errorField, errorMessage = "Please select an option") {
            if ($(`input[name="${name}"]:checked`).length === 0) {
                $(errorField).text(errorMessage).show();
                return false;
            } else {
                $(errorField).text('').hide();
                return true;
            }
        }
        
        document.getElementById('terms').addEventListener('change', function () {
            let errorMessage = document.getElementById('error-message'); // Ensure you have this ID
            if (this.checked) {
                errorMessage.style.display = 'none'; // Hide error message when checked
            }
        });
    
        // Real-time validation for radio buttons
        $('input[name="payment_method"]').on('change', function () {
            validateRadioButton('payment_method', '.payment-method-error', 'Please select a payment method');
        });
    
        // Real-time validation for fields
        $('#name').on('input', function () {
            validateField('#name', '#name-error', null, 'Name is required');
        });
    
        $('#phone').on('input', function () {
            validateField('#phone', '#phone-error', /^[0-9]{11}$/, 'Please enter a valid phone number (11 digits)');
        });
    
        $('#post_code').on('input', function () {
            validateField('#post_code', '#post_code-error', /^[0-9]{3,10}$/, 'Enter a valid postcode');
        });
    
        $('#delivery_address').on('input', function () {
            validateField('#delivery_address', '#delivery_address-error', null, 'Delivery address is required');
        });
    
        // Validate form on submission
        $('#order_form').on('submit', function (e) {
            let errorMessage = document.getElementById('error-message');
            errorMessage.style.display = 'none';
            let isValid = true; // Assume the form is valid at first
    
            // Validate each field
            isValid &= validateField('#name', '#name-error', null, 'Name is required');
            isValid &= validateField('#phone', '#phone-error', /^[0-9]{11}$/, 'Please enter a valid phone number (11 digits)');
            isValid &= validateField('#post_code', '#post_code-error', /^[0-9]{3,10}$/, 'Enter a valid postcode');
            isValid &= validateField('#delivery_address', '#delivery_address-error', null, 'Delivery address is required');
            isValid &= validatePaymentCheckbox();
            isValid &= validateRadioButton('payment_method', '.payment-method-error', 'Please select a payment method');
    
            if (!document.getElementById('terms').checked) {
                    errorMessage.innerHTML = 'Please accept the Terms and Conditions, Privacy Policy and Refund and Return Policy before placing your order.';
                errorMessage.style.display = 'block';
               
                event.preventDefault();
            }  
            
           
    
            // If any validation fails, prevent form submission
            if (!isValid) {
                e.preventDefault();
            }
        });
        
        
        
        function changeColor() {
        let colors = ["red", "black"];
        let i = 0;

        setInterval(function () {
            $("#colorText").css("color", colors[i]);
            i = (i + 1) % colors.length;
            }, 1000); // Change color every 1 second
        }
    
        changeColor();
    });

    </script>
    
    

<script>
    $(document).ready(function () {
        // Fill form based on the selected radio button
        function fillForm(radio) {
            $('#name').val(radio.data('name') || '');
            $('#email').val(radio.data('email') || '');
            $('#phone').val(radio.data('phone') || '');
            $('#post_code').val(radio.data('postcode') || '');
            $('#delivery_address').val(radio.data('address') || '');
        }

        // Automatically select and fill the form for the first radio button
        const firstRadio = $('.address-radio:checked');
        if (firstRadio.length) {
            fillForm(firstRadio);
        }

        // Change event for radio buttons to update the form
        $('.address-radio').on('change', function () {
            if ($(this).is(':checked')) {
                fillForm($(this));
            }
        });
    });
</script>

 <script>
        document.getElementById('delivery-location').addEventListener('change', function() {
            let selectedOption = this.options[this.selectedIndex];
            let shippingCost = parseFloat(selectedOption.getAttribute('data-cost')); // Convert to number

            let sum = {{ $sum   }}; // Inject PHP variable into JavaScript

            // Calculate the new total bill
            let totalBill = Math.round(sum + shippingCost);

            // Update all shipping cost displays
            document.querySelectorAll('.shipping-cost-display').forEach(element => {
                element.textContent = shippingCost + " tk";
            });

            // Update the total bill display
            document.getElementById('total-bill-display').textContent = totalBill + " tk";

            // Update the hidden input field if needed for form submission
            document.getElementById('total-bill').value = totalBill;
            document.getElementById('shipping_cost').value = shippingCost;
        });

    </script>
    <script>
        document.getElementById('delivery-location-cupon').addEventListener('change', function() {
            // alert('ok');
            // Get the selected option
            let selectedOption = this.options[this.selectedIndex];

            // Get the new shipping cost from "data-cost-cupon"
            let shippingCost = parseFloat(selectedOption.getAttribute('data-cost-cupon'));

            // Get the initial coupon new total from Blade (converted to JavaScript variable)
            let couponNewTotal = {{ Session::get('coupon')['new_total'] ?? 0 }};

            // Calculate the new total
            let totalBill = Math.round(couponNewTotal + shippingCost);

            // Update all shipping cost display elements
            document.querySelectorAll('.shipping-cost-display-cupon').forEach(element => {
                element.textContent = shippingCost + " tk";
            });

            // Update the total bill display
            document.getElementById('total-bill-display-cupon').textContent = totalBill + " tk";
            document.getElementById('total-bill-cupon').value = totalBill;
            document.getElementById('shipping_cost_cupon').value = shippingCost;
            document.getElementById('shipping_cost_n').value = shippingCost;
            
        });

    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let codSection = document.getElementById("codSection");
            // let advancePaymentRequired = {{ isset($advancePaymentRequired) ? 'true' : 'false' }};

            let advancePaymentRequired = {{ $advancePaymentRequired ? 'true' : 'false' }} ;

            if (advancePaymentRequired) {
                codSection.style.display = "none"; // COD সেকশন হাইড করবে
            }
        });

    </script>

@endsection
