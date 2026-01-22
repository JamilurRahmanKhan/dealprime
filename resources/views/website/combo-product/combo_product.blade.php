@extends('website.layouts.master')
@section('title', 'Combo Products ')
@section('style')
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('website') }}/{{asset('website')}}/assets/css/three-sixty/jquery-ui.css">
    {{--    <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/ui-lightness/jquery-ui.css"/> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('website') }}/{{asset('website')}}/assets/css/three-sixty/rotate.css">
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
                    <div class="product-slider-container">
                        <div class="label-group">
                            <div class="product-label label-sale">
                                @if ($combo_product->discount_type=='percentage')
                                    {{$combo_product->discount_amount}} %
                                    @else
                                    {{$combo_product->discount_amount}} tk off
                                @endif
                            </div>
                        </div>

                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                            <div class="product-item">
                                <img class="product-single-image"
                                src="{{asset($combo_product->image)}}"
                                data-zoom-image="{{asset($combo_product->image)}}"
                                 width="468" height="468" alt="product" />
                            </div>
                        </div>
                        <!-- End .product-single-carousel -->
                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>
                    </div>


                </div>
                <!-- End .product-single-gallery -->

                <div class="col-lg-7 col-md-6 product-single-details">
                    <h1 class="product-title">{{$combo_product->name}}</h1>
                    <div class="ratings-container">
                        <div class="product-ratings">
                            {{--                            @for ($i = 1; $i <= 5; $i++)--}}
                            @if ($averageRating>0)
                                @if($averageRating>= 5)
                                    <span class="rating-stars">
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
                                        <i class="fa-regular fa-star" style="color: #FAB005"></i>
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
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <!-- End .product-ratings -->

                        <a href="#" class="rating-link">( {{ $ratingCount }}
                            {{ Str::plural('Review', $ratingCount) }} )
                        </a>
                    </div>
                    <!-- End .ratings-container -->

                    <hr class="short-divider">

                    <div class="price-box">
                        <span class="old-price">{{$combo_product->regular_price}} tk</span>
                        <span class="new-price"> {{$combo_product->selling_price}} tk</span>
                    </div>
                    <!-- End .price-box -->

                    <div class="product-desc">
                        <p>
                            {!!$combo_product->short_description!!}
                        </p>
                    </div>
                    <!-- End .product-desc -->

                    <ul class="single-info-list">

                        <li>
                            Code: <strong>{{$combo_product->code}}</strong>
                        </li>
                        <li>
                            Stock Amount: <strong>
                                @if ($combo_product->stock_amount>0 )
                                In Stock
                                @else
                                Stock Out
                                @endif
                            </strong>
                        </li>
                        <form action="{{ route('combo_carts.store') }}" method="POST" id="cartForm" class="mb-1">
                            @csrf
                            <input type="hidden" name="combo_product_id" value="{{ $combo_product->id }}">
                            <input type="hidden" name="color" id="color_id" value="defult">
                            <input type="hidden" name="size" id="size_id" value="defult">
                            <input type="hidden" name="merchant_id" value="{{$combo_product->merchant_id }}">

                            {{-- <div class="product-filters-container">
                                <div class="product-single-filter">
                                    <label>Color:</label>
                                    <ul class="config-size-list config-color-list config-filter-list">
                                        <li>
                                            <a href="javascript:;" class="filter-color border-0" data-toggle="tooltip" data-placement="top"
                                               title="red" style="background-color: red" color_id="1">
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="product-single-filter">
                                    <label>Size:</label>
                                    <ul class="config-size-list">
                                        <li>
                                            <a href="javascript:;" data-toggle="tooltip" data-placement="bottom" title="Xl"
                                               class="d-flex align-items-center justify-content-center filter-size" size_id="1">
                                                Xl
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="product-single-filter">
                                    <label></label>
                                    <a class="font1 text-uppercase clear-btn" href="#">Clear</a>
                                </div>
                            </div> --}}

                            <div class="product-action">
                                <div class="product-single-qty">
                                    <!-- Corrected Quantity Field -->
                                    <label for="qty">Quantity:</label>
                                    <input class="horizontal-quantity form-control" type="number" name="qty" id="qty" value="1" min="1">
                                </div>
                                <!-- End .product-single-qty -->

                                <!-- Add to Cart Button -->
                                <button type="submit" {{$combo_product->stock_amount<1?'disabled':''}} class="btn btn-dark mr-2 mt-3 ">
                                    Add to Cart
                                </button>

                                <!-- Buy Now Button -->
                                <button type="submit"
                                {{$combo_product->stock_amount < 1 ?'disabled':''}}
                                class="btn btn-primary mr-2 mt-3" name="buyNow" value="1">
                                    Buy Now
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- End .product-action -->

                    <!-- End .product single-share -->
                </div>
                <!-- End .product-single-details -->
            </div>
            <!-- End .row -->
        <!-- End .product-single-container -->

        <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content" role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews ({{ $ratingCount }})</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                    <div class="product-desc-content">
                        {!!$combo_product->long_description!!}
                    </div>
                    <!-- End .product-desc-content -->
                </div>
                <!-- End .tab-pane -->



                <div class="tab-pane fade" id="product-reviews-content" role="tabpanel" aria-labelledby="product-tab-reviews">
                    <div class="product-reviews-content">
                        <h3 class="reviews-title">{{ $ratingCount }} review for - {{ $combo_product->name }}</h3>
                        @foreach ($ratings as $rating)
                            @if ($rating->product_id == $combo_product->id)
                                <div class="comment-list">
                                    <div class="comments">
                                        <div class="comment-block ml-0">
                                            <div class="comment-header">
                                                <div class="ratings-container float-sm-right">
                                                    <div class="product-ratings">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <span class="{{ $i <= $rating->rating ? 'text-danger' : 'text-muted' }}">
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
                                <form action="{{ route('rating.store') }}" method="post" class="comment-form m-0">
                                    @csrf
                                    <input type="hidden" name="customer_id"
                                        value="{{ Auth::guard('customer')->user()->id }}">
                                    <input type="hidden" name="product_id" value="{{ $combo_product->id }}">
                                    <input type="hidden" name="product_type" value="2">
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
                @foreach ($combo_products as $combo )
                <div class="product-default">
                    <figure>
                        <a href="{{route('comboProduct.details',['id'=>$combo->id] )}}">
                            <img src="{{asset($combo->image)}}" style="height: 200px; width:100%" alt="product">
                        </a>
                        <div class="label-group">
                            <div class="product-label label-sale">
                                @if ($combo->discount_type =='percentage')
                                    {{$combo->discount_amount}} %
                                @elseif($combo->discount_type=='flat')
                                    {{$combo->discount_amount}} tk off
                                @endif
                            </div>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="#" class="product-category">Combo Products</a>
                        </div>
                        <h3 class="product-title">
                            <a href="{{route('comboProduct.details',['id'=>$combo->id] )}}">{{$combo->name}}</a>
                        </h3>
                        <!-- End .product-container -->
                        <div class="price-box">
                            <del class="old-price">{{$combo->regular_price}} tk</del>
                            <span class="product-price">{{$combo->selling_price}} tk</span>
                        </div>
                        <!-- End .price-box -->
                    </div>
                    <div class="">
                        <a class="w-100" href="{{ route('comboProduct.details', ['id' => $combo->id]) }}">
                            <button class="btn btn-dark btn-sm w-100 ">details</button>
                        </a>
                    </div>

                    <!-- End .product-details -->
                </div>
                @endforeach
            </div>
            <!-- End .products-slider -->
        </div>
        <!-- End .products-section -->

        <hr class="mt-0 m-b-5" />


        <!-- End .row -->
    </div>
    <!-- End .container -->
</main>


<script>
    $(document).ready(function() {
        $('.filter-color').on('click', function() {
            $('.filter-color').removeClass('selected-color');
            $(this).addClass('selected-color');
            var colorId = $(this).attr('color_id');
            $('#color_id').val(colorId);
        });

        $('.filter-size').on('click', function() {
            $('.filter-size').removeClass('selected-size');
            $(this).addClass('selected-size');
            var sizeId = $(this).attr('size_id');
            $('#size_id').val(sizeId);
        });
        $('#cartForm').on('submit', function(event) {
            // if (!$('#color_id').val()) {
            //     alert('Please select a color.');
            //     event.preventDefault();
            // }

            // if (!$('#size_id').val()) {
            //     alert('Please select a size.');
            //     event.preventDefault();
            // }
        });
    });
</script>

@endsection
