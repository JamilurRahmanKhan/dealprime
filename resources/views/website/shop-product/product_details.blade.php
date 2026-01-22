@extends('website.layouts.master')
@section('title')
    {{ $product->name }}
@endsection

@section('meta')
    <meta property="og:image" content="https://dealprime.com.bd/{{$product->image}}"/>
@endsection
@section('style')
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/three-sixty/style.css">
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/three-sixty/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/ui-lightness/jquery-ui.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('website') }}/assets/css/three-sixty/rotate.css">
    <link rel="stylesheet" type="text/css" href="{{asset('website')}}/assets/zoom/magnify.css">
@endsection

@section('body')
    <main class="main">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Products</a></li>
                </ol>
            </nav>
            <div class="product-single-container product-single-default">
                <div class="cart-message d-none">
                    <strong class="single-cart-notice">“Men Black Sports Shoes”</strong>
                    <span>has been added to your cart.</span>
                </div>

                <div class="row">
                    <div class="col-lg-5 col-md-6 product-single-gallery">
                        <div class="label-group" style="top: 0.1rem!important;">
                            <div class="product-label label-hot" style="background: transparent;top: 0.1rem!important;">
                                <img src="{{asset('website')}}/assets/images/productThreeSixtyIcon.gif" style="width:30px" alt="">
                            </div>
                        </div>
                        <div class="rotatebox">
                            <div class="image-slider-container">
                                <div class="image-display" id="image-display">
                                    <img src="" id="current-image" alt="Image Display">
                                </div>

                                <div class="nslider-container">
                                    <input type="range" id="image-slider" class="image-slider  c-image-slider" min="0" max="60" step="1" value="0">
                                </div>
                            </div>
                        </div>
                        <!--Nayem Start-->
                        <div class="prod-thumbnail ">
                            @if(isset($product->image_one))
                                <div class="row c-box">
                                    <div class="col-md-3 col-3">
                                        <div class="c-box-item c-box-item-1">
                                            <img class="xzoom" src="{{asset($product->image_one)}}" data-magnify-src="{{asset($product->image_one)}}" alt="product-thumbnail" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-3">
                                        <div class="c-box-item c-box-item-2">
                                            <img class="example" src="{{asset($product->image_two)}}" data-magnify-src="{{asset($product->image_two)}}" alt="product-thumbnail" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-3">
                                        <div class="c-box-item c-box-item-3">
                                            <img class="example" src="{{asset($product->image_three)}}" data-magnify-src="{{asset($product->image_three)}}" alt="product-thumbnail" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-3">
                                        <div class="c-box-item c-box-item-4">
                                            <img class="example" src="{{asset($product->image_four)}}" data-magnify-src="{{asset($product->image_four)}}" alt="product-thumbnail" />
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="p-1 ">--}}
{{--                                    <img class="xzoom" src="{{asset($product->image_one)}}" data-magnify-src="{{asset($product->image_one)}}"  width="110" style="height: 130px; width:130px" height="110" alt="product-thumbnail" />--}}
{{--                                </div>--}}
{{--                                <div class="p-1">--}}
{{--                                    <img class="example" src="{{asset($product->image_two)}}" data-magnify-src="{{asset($product->image_two)}}" width="110" height="110" style="height: 130px; width:130px" alt="product-thumbnail" />--}}
{{--                                </div>--}}

{{--                                <div class="p-1">--}}
{{--                                    <img class="example" src="{{asset($product->image_three)}}" data-magnify-src="{{asset($product->image_three)}}"  width="110" height="110" style="height: 130px; width:130px" alt="product-thumbnail" />--}}
{{--                                </div>--}}
{{--                                <div class="p-1">--}}
{{--                                    <img class="example" src="{{asset($product->image_four)}}" data-magnify-src="{{asset($product->image_four)}}"  width="110" height="110" style="height: 130px; width:130px" alt="product-thumbnail" />--}}
{{--                                </div>--}}
                                @endif
                        </div>
                        <!--Nayem End-->
                    </div>
                <!-- End .product-single-gallery -->
                <div style="position: absolute; z-index: 9999;">
                    <div class="c-fixed fixed"> 
                        <div class="row">
                            <div class="col-2">
                                <div class="sticky-info" style="float: left;padding: 0% 5%">
                                    <a href="{{ route('home') }}">
                                        <i class="icon-home" style="color: #047E01;margin-top: 5px;font-size: 28px"></i>
                                        {{--                Home--}}
                                    </a>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="sticky-info" style="float: left;padding: 0% 5%">
                                    <a href="{{route('store.list')}}" class="" >
                                        <img src="{{asset('website')}}/assets/images/cart-img/store.jpg" width="40" alt="Add to cart" style="margin-top: 5px">
                                    </a>
                                </div>
                            </div>
                            <div class="col-4" style="padding: 0;">
                                <div class="sticky-info" style="float: left; padding: 0%;width: 100%">

                                    <form class="mb-0 " action="{{ route('carts.store') }}" method="POST" class="cartForm">
                                        @csrf

                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="color" class="color_id">
                                        <input type="hidden" name="size" class="size_id">
                                        <input type="hidden" name="merchent_id" value="{{ $product->merchant_id }}">
                                        <input type="hidden" name="qty"
                                               value="1" min="1">

                                        @if($product->stock_amount == 0 )
                                         
                                            <button type="button" class="c-btn mr-2 border-0" style="background-color: #9b9999" disabled="disabled">
                                                Add to Cart
                                            </button>
                                        @else
                                        <input type="submit"  class="c-btn mr-2 border-0 add-to-cart-button-sticky" style="background-color: #000" value=" Add to Cart" {{ $product->stock_amount == 0 || $product->stock_amount < 0 ? 'disabled' : '' }}
                                                    title="{{ $product->stock_amount  == 0 || $product->stock_amount < 0 ? 'Stock Out' : 'Add to cart' }}" />  
                                           
                                    @endif
                                </div>
                            </div>
                            <div class="col-4" style="padding: 0;">
                                <div class="sticky-info " style="float: left;padding: 0%;width: 100%">
                                    <!-- Buy Now Button -->
                                    @if($product->stock_amount == 0 )
                                        <button type="button" class="c-btn mr-2 border-0" style="background: #8bca9b"   disabled="disabled">
                                            Buy Now
                                        </button>
                                    @else
                                    <input type="submit"  name="buyNow" class="c-btn mr-2 border-0 buy-now-button-sticky" value="Buy Now" 
                                            {{ $product->stock_amount == 0 || $product->stock_amount < 0 ? 'disabled' : '' }}
                                            title="{{ $product->stock_amount == 0 || $product->stock_amount < 0 ? 'Stock Out' : 'Buy Now' }}" />
                                            
                                        <!--<button type="submit" class="c-btn mr-2 border-0" name="buyNow" value="1"-->
                                        <!--        title="{{ $product->stock_amount !== 0 ? 'Buy Now' : 'Stock Out' }}">-->
                                        <!--    Buy Now-->
                                        <!--</button>-->
                                        @endif

                                        </form>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
                    <div class="col-lg-7 col-md-6 product-single-details">
                        <h1 class="product-title">
                            {{ $product->name }}
                        </h1>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                {{--                            @for ($i = 1; $i <= 5; $i++)--}}
                                @if ($averageRating>0)
                                    @if($averageRating>= 5)
                                        <span class="rating-stars">
                                        <i class="fa-regular fa-star" style="color: #FAB005;cursor: text"></i>
                                        <i class="fa-regular fa-star" style="color: #FAB005;cursor: text"></i>
                                        <i class="fa-regular fa-star" style="color: #FAB005;cursor: text"></i>
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
                                    </span>
                                    @elseif($averageRating>=2)
                                        <span class="rating-stars">
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </span>
                                    @elseif($averageRating>=3)
                                        <span class="rating-stars">
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </span>
                                    @elseif($averageRating>=4)
                                        <span class="rating-stars">
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </span>
                                    @elseif($averageRating>=1)
                                        <span class="rating-stars">
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                    </span>
                                    @else
                                    @endif
                                @else
                                    <span class="rating-stars">
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </span>
                                @endif
                                {{--                            @endfor--}}
                            <!-- End .ratings -->
                                {{--                            <span class="tooltiptext tooltip-top"></span>--}}
                            </div>
                            <!-- End .product-ratings -->

                            <a href="#" class="rating-link">( {{ $ratingCount }}
                                {{ Str::plural('Review', $ratingCount) }} )
                            </a>
                        </div>
                        <!-- End .ratings-container -->

                        <hr class="short-divider">

                        @if ($product->discount_amount !=null || $product->discount_amount >0 )
                            <div class="price-box">
                                <span class="old-price">{{ number_format($product->regular_price) }} tk</span>
                                <span class="product-price" style="font-size: 3rem">
                                    {{ number_format($product->selling_price) }}
                                    tk
                                </span>
                            </div>
                        @else
                            <div class="price-box">
                            <span class="product-price" style="font-size: 3rem">
                                    {{ number_format($product->regular_price) }} tk
                            </span>
                            </div>
                        @endif
                    <!-- End .price-box -->

                        <div class="product-desc">
                            <p>
                                {!! $product->short_description !!}
                            </p>
                        </div>
                        <!-- End .product-desc -->

                        <ul class="single-info-list">

                            <li>
                                Stock:
                                <strong>
                                    <a class="product_stock" style="color: {{$product->stock_amount == 0 || $product->stock_amount < 0 ? 'red' : 'green'}}">{{ $product->stock_amount == 0  || $product->stock_amount < 0 ? 'Out of Stock' : 'In Stock' }}</a>
                                </strong>
                            </li>
                            <li>
                                CATEGORY:
                                <strong>
                                    <a href="{{ route('shop_product.list', ['id' => $product->category_id, 'type' => 'category']) }}"
                                       class="product-category">{{ $product->category->name }}</a>
                                </strong>
                            </li>
                            <li>
                                Code:
                                <strong>
                                    <a class="product-category">{{ $product->code }}</a>
                                </strong>
                            </li>
                            <li>
                                Brand:
                                <strong>
                                    <a class="product-category">{{ $product->brand->name }}</a>
                                </strong>
                            </li>

                            <li>
                                TAGs:
                                @foreach ($product_tags as $tag)
                                    <strong><a class="product-category">{{ $tag->tag->name }}</a></strong>,
                                @endforeach

                            </li>
                        </ul>

                        <div class="product-filters-container">
                            <form class="mb-0" action="{{ route('carts.store') }}" method="POST" class="cartForm">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="color" class="color_id">
                                <input type="hidden" name="size" class="size_id">
                                <input type="hidden" name="merchent_id" value="{{ $product->merchant_id }}">

                                <div class="product-single-filter">
                                    <label>Color:</label>
                                    <ul class="config-size-list config-color-list config-filter-list">
                                        @foreach ($product_colors as $color)
                                            <li> 
                                                <a href="javascript:;" class="filter-color border-0" data-toggle="tooltip"
                                                   data-placement="top" title="{{ $color->color->name }}"
                                                   style="background-color: {{ $color->color->code }}"
                                                   color_id="{{ $color->color->id }}">
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="product-single-filter">
                                    <label>Size:</label>
                                    <ul class="config-size-list">
                                        @foreach ($product_sizes as $size)
                                            <li>
                                                <a href="javascript:;" data-toggle="tooltip" data-placement="bottom"
                                                   title="{{ $size->size->code }}"
                                                   class="d-flex align-items-center justify-content-center filter-size"
                                                   size_id="{{ $size->size->id }}">
                                                    {{ $size->size->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="product-action"> 

                                    <div class="product-single-qty">
                                        <input class="horizontal-quantity form-control" type="number" name="qty"
                                               value="1" min="1">
                                    </div>
                                    <!-- Add to Cart Button -->
                                    <input type="submit" class="btn btn-dark mr-2 add-to-cart-button" value=" Add to Cart" {{ $product->stock_amount == 0 || $product->stock_amount < 0 ? 'disabled' : '' }}
                                            title="{{ $product->stock_amount  == 0 || $product->stock_amount < 0 ? 'Stock Out' : 'Add to cart' }}" />
                                    
                                    <!-- Buy Now Button -->
                                     <input type="submit" name="buyNow" class="btn btn-primary mr-2 buy-now-button" value="Buy Now" 
                                            {{ $product->stock_amount == 0 || $product->stock_amount < 0 ? 'disabled' : '' }}
                                            title="{{ $product->stock_amount == 0 || $product->stock_amount < 0 ? 'Stock Out' : 'Buy Now' }}" />
                                            
                                    <!--<button type="submit" class="btn btn-primary mr-2 add-to-cart-button" name="buyNow" value="1"-->
                                    <!--        {{ $product->stock_amount == 0 || $product->stock_amount < 0 ? 'disabled' : '' }}-->
                                    <!--        title="{{ $product->stock_amount == 0 || $product->stock_amount < 0 ? 'Stock Out' : 'Buy Now' }}">-->
                                    <!--    Buy Now-->
                                    <!--</button>-->
                                    
                                     <div id="color-error-message" style="color: red; display: none;"></div>
                                </div>
                            </form>
                            <div class="col col-sm-10 col-md-12 col-xl-6 col-lg-12">
                                @if(Session::has('stockOut'))
                                    <span class="text-danger">{{ Session::get('stockOut') }}</span>
                                @endif
                            </div>
                            @php
                                $customer_id = Auth::guard('customer')->id();
                                $product_id = $product->id;
                            @endphp
                            <a class="product-category pr-4"
                               href="{{ Auth::guard('customer')->check() ? route('wishlist.add', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}"><i
                                    class="icon-wishlist-2"></i> wishlist add
                            </a>
                            <a class="product-category pr-4"
                               href="{{ Auth::guard('customer')->check() ? route('compare.store', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">
                                <i class="fas fa-recycle"></i> Compare
                            </a>
                            <a class="product-category"
                               href="{{ route('shop_product.list',[ $product->user->id,'merchant']) }}">
                                <i class="fas fa-store" style="color: #8089f6"></i> {{$product->user->name}}
                            </a>

                        </div>
                        <!-- End .product single-share -->
                    </div>
                    <!-- End .product-single-details -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .product-single-container -->

            <div class="product-single-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content"
                           role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content"
                           role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews
                            ({{ $ratingCount }} )</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                         aria-labelledby="product-tab-desc">
                        <div class="product-desc-content">
                            <p>{!! $product->long_description !!}</p>
                        </div>
                        <div class="product-desc-content">

                            <table class="table table-bordered table-striped" style="width: 100%;color: #0b0b0b">
                                <tr>
                                    <th colspan="2" class="text-center">Additional Information</th>
                                </tr>
                                @foreach($productComperisons as $productComperison)
                                <tr>
                                    <th style="width: 40%">{!! $productComperison->key_name !!}</th>
                                    <td>{!! $productComperison->key_value !!}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- End .product-desc-content -->


                    </div>
                    <!-- End .tab-pane -->



                    <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                         aria-labelledby="product-tab-reviews">
                        <div class="product-reviews-content">
                            <h3 class="reviews-title">{{ $ratingCount }} review for - {{ $product->name }}</h3>
                            @foreach ($ratings as $rating)
                                @if ($rating->product_id == $product->id)
                                    <div class="comment-list">
                                        <div class="comments">
                                            <div class="comment-block ml-0">
                                                <div class="comment-header">
                                                    <div class="ratings-container float-sm-right">
                                                        <div class="product-ratings">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <span
                                                                    class="{{ $i <= $rating->rating ? 'text-danger' : 'text-muted' }}">
                                                                <i class="ion ion-ios-star"></i>
                                                            </span>
                                                            @endfor
                                                        </div>
                                                    </div>

                                                    <span class="comment-by">
                                                    <strong>{{ $rating->customer->name }}</strong> –
                                                    {{ $rating->created_at->format('F d, Y') }}
                                                </span>
                                                </div>

                                                <div class="comment-content">
                                                    <p>{!! $rating->review !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            <div class="divider"></div>

                            <div class="add-product-review">
                                <h3 class="review-title">Add a review</h3>
                                @if (Auth::guard('customer')->check())
                                    <form action="{{ route('rating.store') }}" method="post" class="comment-form m-0 ">
                                        @csrf
                                        <input type="hidden" name="customer_id"
                                               value="{{ Auth::guard('customer')->user()->id }}">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="product_type" value="1">
                                        <div class="rating-form">
                                            <label for="rating">Your rating <span class="required">*</span></label>
                                            <span class="rating-stars">
                                            <a class="star-1" href="#">1</a>
                                            <a class="star-2" href="#">2</a>
                                            <a class="star-3" href="#">3</a>
                                            <a class="star-4" href="#">4</a>
                                            <a class="star-5" href="#">5</a>
                                        </span>

                                            <select name="rating" id="rating" required="" class="d-none">
                                                <option value="">Rate…</option>
                                                <option value="5">Perfect</option>
                                                <option value="4">Good</option>
                                                <option value="3">Average</option>
                                                <option value="2">Not that bad</option>
                                                <option value="1">Very poor</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Your review <span class="required">*</span></label>
                                            <textarea cols="5" rows="6" name="review" class="form-control form-control-sm"></textarea>
                                            <div class="text-danger">
                                                @error('review')
                                                {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- End .form-group -->
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </form>
                                @else
                                    <h3><a href="{{ route('customer.login') }}">SignIn </a> For Add review</h3>
                                @endif
                            </div>
                            <!-- End .add-product-review -->
                        </div>
                        <!-- End .product-reviews-content -->
                    </div>
                    <!-- End .tab-pane -->
                </div>
                <!-- End .tab-content -->
            </div>
            <!-- End .product-single-tabs -->

            <div class="products-section pt-0">
                <h2 class="section-title">Related Products</h2>

                <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                    @foreach ($category_product as $product)
                        @if ($product->id == $product->id)
                            <div class="product-default">
                                <figure>
                                    <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                        @if ($product->image)
                                        <img src="{{ asset($product->image) }}" style="height:100%; width:100%" alt="product">
                                        @else
                                        <img src="{{ asset('website')}}/assets/images/notfound/notfound.jpeg" style="height: 100%; width:100%" alt="product">
                                        @endif
                                    </a>
                                    <div class="label-group">
{{--                                        @if ($product->type)--}}
{{--                                            <div class="product-label label-hot">--}}
{{--                                                @if ($product->type == 1)--}}
{{--                                                    HOT--}}
{{--                                                @elseif ($product->type == 2)--}}
{{--                                                    LATEST--}}
{{--                                                @elseif ($product->type == 3)--}}
{{--                                                    POPULAR--}}
{{--                                                @elseif ($product->type == 4)--}}
{{--                                                    Recommendation for you--}}
{{--                                                @elseif ($product->type == 5)--}}
{{--                                                    DealPrime picks--}}
{{--                                                @elseif ($product->type == 6)--}}
{{--                                                    Feature--}}
{{--                                                @elseif ($product->type == 7)--}}
{{--                                                    Seasonal Favourite--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
                                        @if ($product->discount_type == 'percentage' )
                                            <div class="product-label label-sale">
                                                {{ $product->discount_amount }}%</div>
                                        @elseif ($product->discount_type == 'flat' )
                                            <div class="product-label label-sale">
                                                {{ $product->discount_amount }}tk off</div>
                                        @endif
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <div class="category-list">
                                        <a href="category.html"
                                           class="product-category">{{ $product->category->name }}</a>
                                    </div>
                                    <h3 class="product-title">
                                        <a
                                            href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">{{ $product->name }}</a>
                                    </h3>
                                    <!-- End .product-container -->
                                    @if ($product->productOffer)
                                        <div class="price-box">
                                            <span class="old-price">{{number_format($product->regular_price)}} tk</span> &ndash;
                                            <span class="product-price ">
                                            {{number_format($product->regular_price - $product->regular_price * ($product->productOffer->discount_amount / 100)) }}
                                            tk
                                    </span>
                                            {{--                                    <span class="badge badge-danger">-{{ $product->productOffer->discount_amount }}%</span>--}}
                                        </div>
                                    @else
                                        <div class="price-box">
                                        <span class="product-price">
                                                {{number_format($product->selling_price) }} tk
                                        </span>
                                        </div>
                                @endif
                                <!-- End .price-box -->
                                    <div class="product-action">
                                    @php
                                        $customer_id = Auth::guard('customer')->id();
                                        $product_id = $product->id;
                                    @endphp
                                    <!-- wishlist -->
                                        <a href="{{ Auth::guard('customer')->check() ? route('wishlist.add', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </a>
                                        <!--details-->
                                        @if ($product->name)
                                            <a
                                                href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                <button class="btn btn-dark btn-sm">details</button>
                                            </a>
                                        @else
                                            <a href="{{ route('comboProduct.details', ['id' => $product->id]) }}">
                                                <button class="btn btn-dark btn-sm">details</button>
                                            </a>
                                    @endif
                                    <!--Compare-->
                                        <a
                                            href="{{ Auth::guard('customer')->check() ? route('compare.store', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fas fa-recycle"></i>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <!-- End .product-details -->
                            </div>
                        @endif
                    @endforeach


                </div>
                <!-- End .products-slider -->
            </div>
            <!-- End .products-section -->
        </div>
        <style>
           /*.popup-overlay-stciky {*/
           /*     display: none;*/
           /*     position: fixed;*/
           /*     top: 0;*/
           /*     left: 0;*/
           /*     width: 100%;*/
           /*     height: 100%;*/
                /*background: rgba(0, 0, 0, 0.5);  */
           /*     display: flex;*/
           /*     justify-content: center;*/
           /*     align-items: center;*/
           /*     z-index: 1000;*/
           /* }*/
            
           /* .popup-content-stciky {*/
           /*     background: #fff;*/
           /*     padding: 20px;*/
           /*     border-radius: 12px;*/
           /*     box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);*/
           /*     width: 300px;*/
           /*     text-align: center;*/
           /*     position: relative;*/
           /*     animation: fadeIn 0.3s ease-in-out;*/
           /* }*/
            
           /* .close-btn-stciky {*/
           /*     position: absolute;*/
           /*     top: 10px;*/
           /*     right: 15px;*/
           /*     font-size: 20px;*/
           /*     cursor: pointer;*/
           /*     color: red!important; */
           /*     transition: color 0.3s;*/
           /* }*/
            
           /* .close-btn-stciky:hover {*/
           /*     color: red;*/
           /* }*/
            
           /* #color-error-message-sticky {*/
           /*     font-size: 16px;*/
           /*     color: red;*/
           /*     margin-top: 10px;*/
           /* }*/
            
           /* @keyframes fadeIn {*/
           /*     from {*/
           /*         opacity: 0;*/
           /*         transform: scale(0.9);*/
           /*     }*/
           /*     to {*/
           /*         opacity: 1;*/
           /*         transform: scale(1);*/
           /*     }*/
           /* }*/

            </style>
        <div id="color-error-popup" class="popup-overlay-stciky" style="display: none;">
            <div class="popup-content-stciky">
                <span class="close-btn-stciky" onclick="closePopup()">&times;</span>
                <p id="color-error-message-sticky"></p>
            </div>
        </div>
        <!-- End .container -->
    </main>
    <!-- End .main -->


    <script>
        const slider = document.getElementById('image-slider');

        slider.addEventListener('input', () => {
            const value = slider.value;
            const max = slider.max;

            // Calculate percentage of the slider
            const percentage = (value / max) * 100;

            // Update the background with a green gradient
            slider.style.background = `linear-gradient(to right, #80b9a3 ${percentage}%, #ddd ${percentage}%)`;
        }); 
        
        $('.filter-color').on('click', function() {
            $('.filter-color').removeClass('selected-color');
            // $(this).addClass('selected-color');
            var colorId = $(this).attr('color_id');
            $('.color_id').val(colorId);
        });
       
        $('.filter-size').on('click', function() {
            $('.filter-size').removeClass('selected-size');
            // $(this).addClass('selected-size');
            var sizeId = $(this).attr('size_id');
            $('.size_id').val(sizeId);
        });
        $('.cartForm').on('submit', function(event) {
             
            if (!$('.color_id').val()) {
                alert('Please select a color.');
                event.preventDefault();
            }

            if (!$('.size_id').val()) {
                alert('Please select a size.');
                event.preventDefault();
            }
        });
        
// ======================= For website Button ========================
    
    //   document.querySelector('.add-to-cart-button').addEventListener('click', function (event) {
           
    //         // let checkedColors = document.querySelectorAll("input[name='color[]']:checked");
    //         let errorMessage = document.getElementById('color-error-message');
    //           if (!$('.color_id').val()) {
    //             errorMessage.style.display = 'block';
    //             errorMessage.innerText = 'Please select a color before adding to cart.';
    //             event.preventDefault();
    //             return false;  // Stop further code execution
    //         }else {
    //             errorMessage.style.display = 'none';
    //         }
        
    //         if (!$('.size_id').val()) {
    //              errorMessage.style.display = 'block';
    //             errorMessage.innerText = 'Please select a size before adding to cart.';
    //             event.preventDefault();
    //             return false;  // Stop further code execution
    //         }else {
    //             errorMessage.style.display = 'none';
    //         }
    //     });
    //     // Buy Now Button Validation
    //     document.querySelector('.buy-now-button').addEventListener('click', function (event) {
    //         let colorErrorMessage = document.getElementById('color-error-message'); 
        
    //         // Check if color is selected
    //         if (!$('.color_id').val()) {
    //             colorErrorMessage.style.display = 'block';
    //             colorErrorMessage.innerText = 'Please select a color before proceeding to buy.';
    //             event.preventDefault();
    //             return false;  // Stop further code execution
    //         } else {
    //             colorErrorMessage.style.display = 'none';
    //         }
        
    //         // Check if size is selected
    //         if (!$('.size_id').val()) {
    //             colorErrorMessage.style.display = 'block';
    //             colorErrorMessage.innerText = 'Please select a size before proceeding to buy.';
    //             event.preventDefault();
    //             return false;  // Stop further code execution
    //         } else {
    //             colorErrorMessage.style.display = 'none';
    //         }
    //     });
        
        // ======================= For Sticky Button ========================
        document.querySelector('.buy-now-button-sticky').addEventListener('click', function (event) {
            let colorErrorMessage = document.getElementById('color-error-message-sticky');
            let popup = document.getElementById('color-error-popup');
        
            // Check if color is selected
            if (!$('.color_id').val()) {
                colorErrorMessage.innerText = 'Please select a color before proceeding to buy.';
                popup.style.display = 'flex';
                event.preventDefault();
                return false;
            }
        
            // Check if size is selected
            if (!$('.size_id').val()) {
                colorErrorMessage.innerText = 'Please select a size before proceeding to buy.';
                popup.style.display = 'flex';
                event.preventDefault();
                return false;
            }
        }); 
        
        
        document.querySelector('.add-to-cart-button-sticky').addEventListener('click', function (event) {
          let colorErrorMessage = document.getElementById('color-error-message-sticky');
            let popup = document.getElementById('color-error-popup');
        
            // Check if color is selected
            if (!$('.color_id').val()) {
                colorErrorMessage.innerText = 'Please select a color before adding to cart.';
                popup.style.display = 'flex';
                event.preventDefault();
                return false;
            }
        
            // Check if size is selected
            if (!$('.size_id').val()) {
                colorErrorMessage.innerText = 'Please select a size before adding to cart.';
                popup.style.display = 'flex';
                event.preventDefault();
                return false;
            } 
        });
         // Close Popup Function
        function closePopup() {
            document.getElementById('color-error-popup').style.display = 'none';
        }
        

    
    // ====================== 4 button work at a time =============
    // Add to Cart Validation
document.querySelectorAll('.add-to-cart-button').forEach(function(button) {
    button.addEventListener('click', function (event) {
        let errorMessage = document.getElementById('color-error-message');

        if (!$('.color_id').val()) {
            errorMessage.style.display = 'block';
            errorMessage.innerText = 'Please select a color before adding to cart.';
            event.preventDefault();
            return false;  // Stop further code execution
        } else {
            errorMessage.style.display = 'none';
        }

        if (!$('.size_id').val()) {
            errorMessage.style.display = 'block';
            errorMessage.innerText = 'Please select a size before adding to cart.';
            event.preventDefault();
            return false;  // Stop further code execution
        } else {
            errorMessage.style.display = 'none';
        }
    });
});

// Buy Now Validation
document.querySelectorAll('.buy-now-button').forEach(function(button) {
    button.addEventListener('click', function (event) {
        let colorErrorMessage = document.getElementById('color-error-message');

        if (!$('.color_id').val()) {
            colorErrorMessage.style.display = 'block';
            colorErrorMessage.innerText = 'Please select a color before proceeding to buy.';
            event.preventDefault();
            return false;  // Stop further code execution
        } else {
            colorErrorMessage.style.display = 'none';
        }

        if (!$('.size_id').val()) {
            colorErrorMessage.style.display = 'block';
            colorErrorMessage.innerText = 'Please select a size before proceeding to buy.';
            event.preventDefault();
            return false;  // Stop further code execution
        } else {
            colorErrorMessage.style.display = 'none';
        }
    });
});
 

        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".add-to-cart-btn").forEach(function (button) {
                if (button.dataset.stock == "0" || button.dataset.stock < "0") {
                    button.disabled = true;
                    button.style.opacity = "0.5"; // Optional: Make it look disabled
                    button.style.pointerEvents = "none"; // Prevents touch/click on mobile
                }
            });
        });


    </script>
<!--===================== SPINNER IMAGE ==============-->
    <script>
        // Array of 24 image URLs (sorted by file name from 1 to 24)
        var images = [
            <?php
                foreach($product_Image as $pr_img){
                $image =  $pr_img->image;
                ?>
                "{{asset($image)}}",

            <?php } ?>
        ]
        // console.log($image)
        // rotate( imageLists  );

        const imageSlider = document.getElementById("image-slider");
        const imageName = document.getElementById("image-name");
        const currentImage = document.getElementById("current-image");
        imageSlider.min = 0;
        imageSlider.max = images.length > 0 ? images.length - 1 : 0;
        // Function to update the displayed image and its URL
        function updateImage(value) {
            const selectedImage = images[value];

            // Update the image source
            currentImage.src = selectedImage;

            // Display the image URL or name
            // imageName.textContent = `Image URL: ${selectedImage}`;
        }

        // Event listener for slider input
        imageSlider.addEventListener("input", function() {
            const value = parseInt(imageSlider.value);
            updateImage(value);
        });

        // Initialize the image and display the first image (ensuring it starts at 0)
        updateImage(0); // Start with the first image
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.4.5/mobile-detect.min.js"></script>
    {{--    <script src="{{ asset('website') }}/assets/js/three-sixty/rotate.js"></script>--}}



@endsection
