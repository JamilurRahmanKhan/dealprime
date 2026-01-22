@extends('website.layouts.master')
@section('title', 'Customer Dashboard')
@section('body')
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                My Account
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>My Account</h1>
            </div>
        </div>

        <div class="container account-container custom-account-container">
            <div class="row">
                <div class="sidebar widget widget-dashboard mb-lg-0 mb-3 col-lg-3 order-0">
                    <h2 class="text-uppercase">My Account</h2>
                    <ul class="nav nav-tabs list flex-column mb-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab"
                                aria-controls="dashboard" aria-selected="true">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"
                                aria-controls="order" aria-selected="true">
                                Orders
                                <span class="btn btn-sm btn-primary">
                                    {{ $orders->count() }}
                                </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                                aria-controls="address" aria-selected="false">Billing & Shipping Addresses</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab"
                                aria-controls="edit" aria-selected="false">Account
                                details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('wishlist') }}">Wishlist</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customer.logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9 order-lg-last order-1 tab-content">
                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                        <div class="dashboard-content">
                            <p class="text-warning font-14">{{ Session::get('success') }}</p>

                            <p>
                                Hello <strong
                                    class="text-dark">{{ Auth::guard('customer')->user()->name }}({{ Auth::guard('customer')->user()->phone }})</strong>
                                (not
                                <strong class="text-dark">{{ Auth::guard('customer')->user()->name }}</strong>?
                                <a href="{{ route('customer.logout') }}" class="btn btn-link ">Log out</a>)
                            </p>

                            <p>
                                From your account dashboard you can view your
                                <a class="btn btn-link link-to-tab" href="#order">recent orders</a>,
                                manage your
                                <a class="btn btn-link link-to-tab" href="#address">shipping and billing
                                    addresses</a>, and
                                <a class="btn btn-link link-to-tab" href="#edit">edit your password and account
                                    details.</a>
                            </p>

                            <div class="mb-4"></div>

                            <div class="row row-lg">
                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#order" class="link-to-tab"><i class="sicon-social-dropbox"></i></a>
                                        <div class="feature-box-content">
                                            <h3>ORDERS </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#address" class="link-to-tab"><i class="sicon-location-pin"></i></a>
                                        <div class="feature-box-content">
                                            <h3> Billing & Shipping ADDRESSES</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="#edit" class="link-to-tab"><i class="icon-user-2"></i></a>
                                        <div class="feature-box-content p-0">
                                            <h3>ACCOUNT DETAILS</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="{{ route('wishlist') }}"><i class="sicon-heart"></i></a>
                                        <div class="feature-box-content">
                                            <h3>WISHLIST</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="feature-box text-center pb-4">
                                        <a href="{{ route('customer.logout') }}"><i class="sicon-logout"></i></a>
                                        <div class="feature-box-content">
                                            <h3>LOGOUT</h3>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End .row -->
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="order" role="tabpanel">
                        <div class="order-content">
                            <h3 class="account-sub-title d-none d-md-block"><i
                                    class="sicon-social-dropbox align-middle mr-3"></i>Orders</h3>
                            <div class="order-table-container text-center">
                                @if ($orders->count())
                                    <table class="table table-order ">
                                        <thead>
                                            <tr>
                                                <th class="order-id">Sl</th>
                                                <th class="order-id">ORDER Number </th>
                                                <th class="order-date">DATE</th>
                                                <th class="order-status">STATUS</th>
                                                <th class="order-price">TOTAL</th>
                                                <th class="order-action">ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $index => $order)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{$order->order_number}}</td>
                                                    <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
                                                    </td>
                                                    <td>
                                                        @if ($order->order_status == 0)
                                                        <span class="badge bg-danger p-3 text-white"> <i class="fas fa-times-circle"></i> Order Deleted</span>
                                                        @elseif ($order->order_status == 1)
                                                           <span class="badge bg-warning p-3 text-white"><i class="fas fa-check-square"></i>  Confirmed Order</span>
                                                        @elseif ($order->order_status == 2)
                                                           <span class="badge bg-primary p-3 text-white"> <i class="fas fa-spinner"></i>  Processing</span>
                                                        @elseif ($order->order_status == 3)
                                                        <span class="badge bg-info p-3 text-white"><i class="fas fa-check"></i> Delivery complete</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ number_format($order->order_total) }} tk
                                                    </td>
                                                    <td>
                                                        <a href="{{route('order.details',$order->id)}}" target="_blank">
                                                            <button class="btn btn-outline-warning"> <i class="far fa-file-alt"></i> Details</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr class="my-5 p-0">
                                    <a href="{{ route('shop_product.list', 'all_product') }}" class="btn btn-dark">Go
                                        Shop</a>
                                @else
                                    <div class="text-danger my-5">Order Not found! </div>
                                    <a href="{{ route('shop_product.list', 'all_product') }}" class="btn btn-dark">Go
                                        Shop</a>
                                @endif
                            </div>

                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="address" role="tabpanel">
                        <h3 class="account-sub-title d-none d-md-block mb-1"><i
                                class="sicon-location-pin align-middle mr-3"></i>Billing & Shipping address</h3>
                        <div class="addresses-content">
                            <p class="mb-4">
                                You Can only added 2 Billing address at a time.
                            </p>
                           @if ($deliveryAddress->count()!==2)
                           <a href="#shipping" class="btn btn-default address-action link-to-tab"
                               style="background-color: rgb(245, 234, 234)">
                               Add Address
                           </a>
                           @endif
                            <div class="row mt-2">
                                @foreach ($deliveryAddress as $index=>$address )
                                <!--address 1-->
                                <div class="address col-md-6 mt-5 mt-md-0">
                                    <div class="heading d-flex">
                                        <h4 class="text-dark mb-0 ">
                                            Address <button class="btn btn-info btn-sm" disabled>{{$index +1}}</button>
                                        </h4>
                                    </div>
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>{{$address->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{$address->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>{{$address->phone}}</td>
                                        </tr>
                                        <tr>
                                            <td>Country</td>
                                            <td>{{$address->country}}</td>
                                        </tr>
                                        <tr>
                                            <td>Zip Code </td>
                                            <td>{{$address->zip_code}}</td>
                                        </tr>
                                        <tr>
                                            <td>Billing & Shipping Address </td>
                                            <td>{!!$address->delivery_address!!}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                <a href="{{route('destroy.billing_address',$address->id)}}">
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="edit" role="tabpanel">
                        <h3 class="account-sub-title d-none d-md-block mt-0 pt-1 ml-1">
                            <i class="icon-user-2 align-middle mr-3 pr-1"></i>Account Details
                        </h3>
                        <div class="account-content">
                            <form action="#" method="POST">
                                @csrf
                                <div class="change-password">
                                    <h3 class="text-uppercase mb-2">Password Change</h3>
                                    <input type="hidden" name="customer_id" value="{{ Auth::guard('customer')->user()->id }}">

                                    <div class="form-group">
                                        <label for="password">Current Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control" id="password"  />
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="new-password">New Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="new-password" name="new_password"  />
                                        @error('new_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="confirm-password">Confirm New Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="confirm-password" name="confirm_password"  />
                                        @error('confirm_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-dark mr-0">
                                        Save changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div><!-- End .tab-pane -->



                    <div class="tab-pane fade" id="shipping" role="tabpanel">
                        <div class="address account-content mt-0 pt-2">
                            <h4 class="title mb-3">Billing & Shipping Address</h4>

                            <form class="mb-2" action="{{route('store.billing_address')}}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label>Full name </label>
                                    <input type="text" name="name" value="{{ Auth::guard('customer')->user()->name }}" class="form-control" disabled>
                                    <input type="hidden" name="name" value="{{ Auth::guard('customer')->user()->name }}" class="form-control" >
                                    <input type="hidden" name="customer_id" value="{{ Auth::guard('customer')->user()->id }}" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label>Email </label>
                                    <input type="text" name="email" value="{{ Auth::guard('customer')->user()->email }}" class="form-control" disabled>
                                    <input type="hidden" name="email" value="{{ Auth::guard('customer')->user()->email }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Phone <span class="required">*</span></label>
                                    <input type="text" name="phone" placeholder="Phone" class="form-control" id="phone">
                                    <div class="text-danger" id="phoneError"></div>
                                </div>
                                <div class="form-group">
                                    <label>Country <span class="required">*</span></label>
                                    <input type="text" name="country" value="Bangladesh" class="form-control" id="country">
                                    <div class="text-danger" id="countryError"></div>
                                </div>
                                <div class="form-group">
                                    <label>Postcode / ZIP <span class="required">*</span></label>
                                    <input type="text" name="zip_code" placeholder="Zip Code " class="form-control" id="zip_code">
                                    <div class="text-danger" id="zipCodeError"></div>
                                </div>
                                <div class="form-group">
                                    <label>Delivery Address <span class="required">*</span></label>
                                    <textarea class="form-control" placeholder="Delivery Address" name="delivery_address" cols="30" rows="10" id="delivery_address"></textarea>
                                    <div class="text-danger" id="deliveryAddressError"></div>
                                </div>


                                <div class="form-footer mb-0">
                                    <div class="form-footer-right">
                                        <button type="submit" class="btn btn-dark py-4">
                                            Save Address
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- margin -->
    </main><!-- End .main -->


    <script>
        $(document).ready(function () {
    function validateField(fieldId, errorId, validationFn, errorMsg) {
        const value = $(`#${fieldId}`).val().trim();
        if (!validationFn(value)) {
            $(`#${errorId}`).text(errorMsg);
            return false;
        } else {
            $(`#${errorId}`).text('');
            return true;
        }
    }

    function isNotEmpty(value) {
        return value.length > 0;
    }

    function isPhoneValid(value) {
        const phoneRegex = /^[0-9]{11}$/;
        return phoneRegex.test(value);
    }

    function isZipValid(value) {
        return /^[0-9]{4,6}$/.test(value);
    }

    $("#phone").on("input", function () {
        validateField("phone", "phoneError", isPhoneValid, "Phone must be 11 digits.");
    });

    $("#country").on("input", function () {
        validateField("country", "countryError", isNotEmpty, "Country is required.");
    });

    $("#zip_code").on("input", function () {
        validateField("zip_code", "zipCodeError", isZipValid, "ZIP code must be 4-6 digits.");
    });

    $("#delivery_address").on("input", function () {
        validateField("delivery_address", "deliveryAddressError", isNotEmpty, "Delivery address is required.");
    });

    $("form").on("submit", function (e) {
        const isPhoneValidField = validateField("phone", "phoneError", isPhoneValid, "Phone must be 11 digits.");
        const isCountryValid = validateField("country", "countryError", isNotEmpty, "Country is required.");
        const isZipValidField = validateField("zip_code", "zipCodeError", isZipValid, "ZIP code must be 4-6 digits.");
        const isDeliveryAddressValid = validateField("delivery_address", "deliveryAddressError", isNotEmpty, "Delivery address is required.");

        if (!isPhoneValidField || !isCountryValid || !isZipValidField || !isDeliveryAddressValid) {
            e.preventDefault();
        }
    });
});

    </script>
@endsection
