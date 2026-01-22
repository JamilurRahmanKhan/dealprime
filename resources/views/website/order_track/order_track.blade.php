@extends('website.layouts.master')
@section('title','Order Track')
@section('body')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                           Order Tracking
                        </li>
                    </ol>
                </div>
            </nav>

            <h1> Order Tracking</h1>
        </div>
    </div>

    <div class="container login-container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <img src="https://cdn.dribbble.com/users/1954667/screenshots/4166102/track-2.gif" style="height: 230px; width:100%;" alt="Tracking GIF">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 " style="height: 250px">
                <div class="card py-2" >
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="orderNumber" class="form-label">Order Number</label>
                            <input type="text" class="form-control" id="orderNumber" placeholder="Enter your order number" required>
                            <p id="errorMessage" style="color: red!important; display: none;">Please Enter Order number.</p>

                        </div>
                        <input type="text"  class="btn btn-primary w-100" id="trackOrder" value="Track Order">
                        <!--<input type="text"  class="btn btn-primary w-100"  onclick="searchByOrderTracking()" id="trackOrder" value="Track Order">-->
                         
                    </div>
                </div>
            </div>
        </div>
        <div class="row"   id="orderTrackDiv">
            <div class="mt-5"></div>
{{--            <div id="bar-progress" class="mt-5 mt-lg-0">--}}
{{--                <div class="step step-active">--}}
{{--                    <span class="number-container">--}}
{{--                        <span class="number">1</span>--}}
{{--                    </span>--}}
{{--                    <h5>Welcome</h5>--}}
{{--                </div>--}}
{{--                <div class="seperator"></div>--}}
{{--                <div class="step">--}}
{{--                    <span class="number-container">--}}
{{--                        <span class="number">2</span>--}}
{{--                    </span>--}}
{{--                    <h5>Build Plan</h5>--}}
{{--                </div>--}}
{{--                <div class="seperator"></div>--}}
{{--                <div class="step">--}}
{{--                    <span class="number-container">--}}
{{--                        <span class="number">3</span>--}}
{{--                    </span>--}}
{{--                    <h5>Delivery</h5>--}}
{{--                </div>--}}
{{--                <div class="seperator"></div>--}}
{{--                <div class="step">--}}
{{--                    <span class="number-container">--}}
{{--                        <span class="number">4</span>--}}
{{--                    </span>--}}
{{--                    <h5>Review &amp; Pay</h5>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-12 col-md-10 hh-grayBox pt45 pb20">--}}
{{--                <div class="row justify-content-between">--}}
{{--                    <div class="order-tracking completed">--}}
{{--                        <span class="is-complete"></span>--}}
{{--                        <p>Processing<br><span>Mon, June 24</span></p>--}}
{{--                    </div>--}}
{{--                    <div class="order-tracking completed">--}}
{{--                        <span class="is-complete"></span>--}}
{{--                        <p>Order Confirmed<br><span>Mon, June 24</span></p>--}}
{{--                    </div>--}}
{{--                    <div class="order-tracking">--}}
{{--                        <span class="is-complete"></span>--}}
{{--                        <p>Delivered<br><span>Fri, June 28</span></p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

</main><!-- End .main -->
@endsection
{{--    <!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <style>--}}
{{--        /* Include your inline styles here */--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}
{{--<div class="invoice-box">--}}
{{--    <table>--}}
{{--        <!-- Your invoice HTML structure here, with Blade syntax -->--}}
{{--        <tr class="top">--}}
{{--            <td colspan="2">--}}
{{--                <table>--}}
{{--                    <tr>--}}
{{--                        <td class="title">--}}
{{--                            <img src="{{ asset('website/assets/images/logo/deal.jpg') }}" style="height: 70px; width:200px" alt="Logo">--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            Invoice #: {{ $order->order_number }}<br>--}}
{{--                            Created: {{ date('F j, Y') }}<br>--}}
{{--                            Order Date: {{ date('ymj', strtotime($order->order_date)) }}--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                </table>--}}
{{--            </td>--}}
{{--        </tr>--}}

{{--        <!-- Repeat other parts of the HTML, using Blade syntax -->--}}
{{--    </table>--}}
{{--</div>--}}
{{--</body>--}}
{{--</html>--}}
