@extends('website.layouts.master')
@section('title','Cart')
@section('body')
<style>
    .updateBtn {
    height: 48px;
    width: 45px;
    padding: 0.5em 1em;
    font-size: 1.1rem;
}
</style>
<main class="main">
    <div class="container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li class="active">
                <a href="{{route('carts.index')}}">Shopping Cart</a>
            </li>
{{--            <li>--}}
{{--                <a href="{{route('checkout')}}">Checkout</a>--}}
{{--            </li>--}}
{{--            <li class="disabled">--}}
{{--                <a href="#">Order Complete</a>--}}
{{--            </li>--}}
        </ul>
    @if($products->count() > 0)
        <div class="row">
            <div class="col-lg-8">

{{--                <a href="{{ route('carts.destroy') }}" class="mb-2">--}}
{{--                    <button class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> All delete</button>--}}
{{--                </a>--}}
                <div class="col-12 col-sm-6 col-md-6 col-xl-12 col-lg-12">
                    @if(Session::has('stockOut'))
                        <span class="text-danger">{{ Session::get('stockOut') }}</span>
                    @endif
                </div>
                <br>
                <div class="cart-table-container mt-1">
                    <table class="table table-cart table-large-device">
                        <thead>
                        <tr>
                            <th class="thumbnail-col"></th>
                            <th class="product-col">Product</th>
                            <th class="price-col">Price</th>
                            <th class="qty-col">Quantity</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $sum=0 @endphp
                        @foreach ($products as $product)
                            <tr class="product-row">
                                <td>
                                    <figure class="product-image-container">
                                        <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}" class="product-image">
                                            <img src="{{asset($product->options->image)}}" alt="product">
                                        </a>

                                        <a href="{{ route('carts.rowDelete', ['rowId' => $product->rowId]) }}" class="btn-remove icon-cancel" title="Remove Product"></a>
                                    </figure>
                                </td>
                                <td class="product-col">
                                    <h5 class="product-title">
                                        <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">{{$product->name}}</a>
                                        <a >{{$product->options->color}}</a>
                                        <a >{{$product->options->size}}</a>
                                    </h5>
                                </td>
                                <td>
                                    {{number_format($product->price) }} tk
                                    @if ($product->options->product_discount)
                                        <span class="btn btn-sm bg-danger"> {{$product->options->product_discount}} %</span>
                                    @endif
                                </td>
                                <td>
                                    <form class="mb-0 d-flex align-items-center" action="{{ route('update.qty', $product->rowId) }}" method="post">
                                        @csrf
                                        <div class="product-action d-flex align-items-center">
                                            <div class="product-single-qty d-inline-flex align-items-center">
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                <input class="horizontal-quantity form-control me-2" type="number" name="qty" value="{{ $product->qty }}" min="1" style="width: 80px;">
                                            </div>

                                            <button class="btn btn-info updateBtn btn-sm d-inline-flex align-items-center" style="padding: 6px 8px;">
                                                <i class="fa fa-check" style="font-size: 15px;"></i>
                                            </button>
                                        </div>

                                    </form>
                                </td>

                                <td class="text-right">
                                    @php
                                        $total_price = $product->qty * $product->price;
                                    @endphp
                                    <span class="subtotal-price">{{number_format($total_price)}} tk</span>
                                </td>
                            </tr>
                            @php $sum=$sum+$total_price @endphp
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5" class="clearfix">
                                <!--<div class="float-left">-->
                                <!--    <div class="cart-discount">-->
                                <!--        <span class="text-success">{{ Session::get('applied') }}</span>-->
                                <!--        @if(!Session::get('coupon'))-->
                                <!--            <form action="{{ route('get.coupon') }}" class="mb-0" method="post" >-->
                                <!--                @csrf-->
                                <!--                <div class="input-group">-->
                                <!--                    <input type="text" name="coupon_code"  value="{{ old('coupon_code') }}" class="form-control form-control-sm" placeholder="Coupon Code" >-->
                                <!--                    <div class="input-group-append">-->
                                <!--                        <button class="btn btn-sm" type="submit">Apply Coupon</button>-->
                                <!--                    </div>-->
                                <!--                </div> -->
                                <!--            </form>-->
                                <!--        @else-->
                                <!--            <form action="{{ route('remove.coupon') }}" class="mb-0" method="post" >-->
                                <!--                @csrf-->
                                <!--                <div class="input-group">-->
                                <!--                    <input type="text" name="coupon_code" value="{{ Session::get('coupon')['code'] }} Coupon Applied"  class="form-control form-control-sm" placeholder="Coupon Code" >-->
                                <!--                    <div class="input-group-append">-->
                                <!--                        <button class="btn btn-sm" type="submit">Remove Coupon</button>-->
                                <!--                    </div>-->
                                <!--                </div> -->
                                <!--            </form>-->
                                <!--        @endif-->
                                <!--        <span class="text-danger m-2">-->
                                <!--                {{ Session::get('error') }}-->
                                <!--            @error('coupon_code'){{$message}}@enderror-->
                                <!--            </span>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!-- End .float-left -->

                                <div class="float-right">
                                    <a href="{{ route('shop_product.list', 'all_product') }}">
                                        <button type="submit" class="btn btn-shop btn-update-cart">
                                            Continue Shopping
                                        </button>
                                    </a>
                                </div><!-- End .float-right -->
                            </td>
                        </tr>
                        </tfoot>
                    </table>

                        @php $sum=0 @endphp
                        @foreach ($products as $product)
                            <div class="row mt-2 mb-2 table-medium-small-device">
                                    <div class="col-3">
                                        <figure class="product-image-container">
{{--                                            <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}" class="product-image">--}}
                                                <img src="{{asset($product->options->image)}}" alt="product">
{{--                                            </a>--}}
                                            <a href="{{ route('carts.rowDelete', ['rowId' => $product->rowId]) }}" class="btn-remove icon-cancel" title="Remove Product"></a>
                                        </figure>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="product-title">
                                            <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">{{$product->name}}</a>
                                            <br><a>Color:  {{$product->options->color}}</a><br>
                                            <a >Size:  {{$product->options->size}}</a>
                                        </h5>
                                    </div>
                                    <div class="col-3 unit-price">
                                        <span>unit price</span>
                                        {{number_format($product->price) }} tk
                                    </div>
                                    <div class="col-6   ">
                                        @if ($product->options->product_discount)
                                            <span class="btn btn-sm bg-danger"> {{$product->options->product_discount}} %</span>
                                        @endif
                                        <form class="mb-0 d-flex align-items-center" action="{{ route('update.qty', $product->rowId) }}" method="post">
                                            @csrf
                                            <div class="product-action d-flex align-items-center">
                                                <div class="product-single-qty d-inline-flex align-items-center">
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <input class="horizontal-quantity form-control me-2" type="number" name="qty" value="{{ $product->qty }}" min="1" style="width: 80px;">
                                                </div>

                                                <button class="btn btn-info updateBtn btn-sm d-inline-flex align-items-center" style="padding: 6px 8px;width: 35px;height: 35px">
                                                    <i class="fa fa-check" style="font-size: 15px;"></i>
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="col-6 sub-total">
                                    @php
                                        $total_price = $product->qty * $product->price;
                                    @endphp
                                    <span class="subtotal-price">{{number_format($total_price)}} tk</span>
                                    </div>
                                @php $sum=$sum+$total_price @endphp
                            </div>
                            <hr class="c-none">
                        @endforeach
                        <!--<div class="float-left c-none">-->
                        <!--    <div class="cart-discount">-->
                        <!--        <span class="text-success">{{ Session::get('applied') }}</span>-->
                        <!--        @if(!Session::get('coupon'))-->
                        <!--            <form action="{{ route('get.coupon') }}" class="mb-0" method="post" >-->
                        <!--                @csrf-->
                        <!--                <div class="input-group">-->
                        <!--                    <input type="text" name="coupon_code"  value="{{ old('coupon_code') }}" class="form-control form-control-sm" placeholder="Coupon Code" >-->
                        <!--                    <div class="input-group-append c-apply-btn">-->
                        <!--                        <button class="btn btn-shop btn-update-cart " type="submit">Apply Coupon</button>-->
                        <!--                    </div>-->
                        <!--                </div><!-- End .input-group -->-->
                        <!--            </form>-->
                        <!--        @else-->
                        <!--            <form action="{{ route('remove.coupon') }}" class="mb-0" method="post" >-->
                        <!--                @csrf-->
                        <!--                <div class="input-group">-->
                        <!--                    <input type="text" name="coupon_code" value="{{ Session::get('coupon')['code'] }} Coupon Applied"  class="form-control form-control-sm" placeholder="Coupon Code" >-->
                        <!--                    <div class="input-group-append">-->
                        <!--                        <button class="btn btn-sm" type="submit">Remove Coupon</button>-->
                        <!--                    </div>-->
                        <!--                </div><!-- End .input-group -->-->
                        <!--            </form>-->
                        <!--        @endif-->
                        <!--        <span class="text-danger m-2">-->
                        <!--                {{ Session::get('error') }}-->
                        <!--            @error('coupon_code'){{$message}}@enderror-->
                        <!--            </span>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!-- End .float-left -->
                    <div class="float-right c-con-btn">
                        <a href="{{ route('shop_product.list', 'all_product') }}">
                            <button type="submit" class="btn btn-shop btn-update-cart c-none ">
                                Continue Shopping
                            </button>
                        </a>
                    </div><!-- End .float-right -->
                </div><!-- End .cart-table-container -->
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="cart-summary mt-4">
                    <h3>CART TOTALS</h3>
                    <!-- without coupon discount -->
                    @if (!Session::get('coupon'))
                    <table class="table table-totals">
                        <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td>{{number_format($sub_total=$sum) }} tk</td>
                            </tr>
{{--                            <tr>--}}
{{--                                <td>Tax total[15%]</td>--}}
{{--                                <td>{{number_format($tax = round($sum * 0.15))  }}  tk</td>--}}
{{--                            </tr>--}}
                            <!--<tr>-->
                            <!--    <td>Shipping total</td>-->
                            <!--    <td>{{ $shippingCost = 100 }} tk</td>-->
                            <!--</tr>-->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td>{{ number_format(round($total_bill= $sum  ))}} tk</td>
                            </tr>
                        </tfoot>
                    </table>
                    @else
                    <!-- with coupon discount -->
                    <table class="table table-totals">
                        <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td>{{number_format($sub_total=$sum) }} tk</td>
                            </tr>
                            <tr>
                                <td>
                                    Coupon
                                    [ {{Session::get('coupon')['code']}}]
                                    <form action="{{route('remove.coupon')}}" method="post" class="m-0 my-2">
                                        @csrf
                                        <input type="hidden" name="coupon_code" id="couponCode" value="{{ Session::get('coupon')['code'] }} Coupon Applied">
                                        <button class="btn btn-danger btn-sm ">Delete</button>
                                    </form>

                                </td>
                                <td>
                                    (-) @if (Session::get('coupon')['type']=='percentage')
                                    {{Session::get('coupon')['amount']}}%
                                    @elseif(Session::get('coupon')['type']=='fixed')
                                    {{Session::get('coupon')['amount']}}tk
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>After Discount Subtotal</td>
                                <td>{{number_format(Session::get('coupon')['new_total']) }}  tk</td>
                            </tr>
                            {{-- <tr>
                                <td>Tax total</td>
                                <td>{{number_format(Session::get('coupon')['tax']) }}  tk</td>
                            </tr> --}}
                            <tr>
                                <td>Shipping total</td>
                                <td>{{Session::get('coupon')['shippingCost']}} tk</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td>{{number_format(Session::get('coupon')['grand_total'])}} tk</td>
                            </tr>
                        </tfoot>
                    </table>
                    @endif
                  
                    <div class="checkout-methods">
                        <a href="{{route('checkout')}}" class="btn btn-block btn-dark">Proceed to Checkout
                            <i class="fa fa-arrow-right"></i></a>
                    </div>
                   
                </div><!-- End .cart-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->
        @else
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center text-center" style="min-height: 5vh;">
                <img src="{{ asset('/') }}website/assets/images/notfound/cart_empty.gif" alt="Cart Empty" width="300" class="img-fluid">
            </div>
        </div> 
        @endif
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
</main><!-- End .main -->


@endsection
