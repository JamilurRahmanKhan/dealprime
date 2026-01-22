@extends('website.layouts.master')
@section('title', 'Home')
@section('style')
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('website') }}/assets/css/demo35.min.css">
@endsection
@section('body')
    <style>
        .tosterStyle {
            padding: 10px;
            border-radius: 5px;
            background: #e4f541;
        }
    </style>
    <!--Hero / intro section-->
    @include('website.layouts.hero')
    <!--/ Hero / intro section-->

    <!-- security purpos-->
    @if($policys->count() !=0)
    <section class="product-common-section">
        <div class="container">
            <div class="   rounded">
                <div class="tab-content">
                <!-- All Products -->
                <div class="tab-pane fade show active" id="all">
                    <div class=" info-boxes-slider owl-carousel mb-1 owl-theme nav-outer"
                 data-owl-options="{
                                    'items' : 1,
                                    'center':true,
                                    'nav': false,
                                    'margin': 0,
                                    'dots':true,
                                     'responsive': {
                                        '480': {
                                         'items': 2
                                        },
                                        '576': {
                                         'items': 3
                                        },
                                        '768': {
                                         'items': 3
                                        },
                                        '992': {
                                         'items': 3
                                        },
                                        '1080': {
                                         'items': 3
                                        },
                                        '1320': {
                                         'items': 3
                                        },
                                        '1400': {
                                         'items': 5
                                        },
                                        '1980': {
                                         'items': 5
                                        }
                                    }
                }" >
                @foreach ($policys as $policy )  
                    <div class="info-box info-box-icon-left m-0" style="height:100%">
                        {{-- <i class="icon-shipping text-primary"></i> --}}
                        <img src="{{ asset($policy->image) }}" style="height: 50px; width: 50px" alt="">
                        <div class="info-content p-2 p-md-4 p-lg-5">
                            <h4 class="ls-n-25">{!! $policy->title !!}</h4>
                            <p class="font2 font-weight-light text-body ls-10">{!! $policy->sub_title !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    @endif
    <!--/ security purpos-->

    <!--=================Hot product section=========================-->

    @if($products->where('type', 1)->count() !=0)
    <section class="product-common-section">
        <div class="container">
            <div class="appear-animate" data-animation-name="fadeIn" data-animation-delay="200">
                <h2 class="section-title" >
                    Hot
                </h2>
                <div class="products-container product-slider-tab rounded">
                    <!-- Tab Content for Products -->
                    <div class="tab-content">
                        <!-- All Products -->
                        <div class="tab-pane fade show active" id="all">
                            <div class="products-slider owl-carousel owl-theme nav-outer"
                                 data-owl-options="{
                                    'items' : 2,
                                    'nav': true,
                                    'margin': 0,
                                    'dots':true,
                                     'responsive': {
                                         '576': {
                                             'items': 3
                                         },
                                         '768': {
                                             'items': 3
                                         },
                                         '992': {
                                             'items': 6
                                         },
                                         '1080': {
                                             'items': 6
                                         },
                                         '1320': {
                                             'items': 6
                                         },
                                         '1400': {
                                             'items': 6
                                         },
                                         '1980': {
                                             'items': 10
                                         }
                                    }
                                }">
                                @foreach ($products->where('type', 1)  as $product)
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a
                                                href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                @if ($product->image)
                                                    <img src="{{ asset($product->image) }}" alt="product"  >
                                                @else
                                                    <img src="{{ asset('website')}}/assets/images/notfound/notfound.jpeg" alt="product">
                                                @endif
                                            </a>
                                            <div class="label-group">
{{--                                                @if ($product->type)--}}
{{--                                                    <div class="product-label label-hot">--}}
{{--                                                        @if ($product->type == 4)--}}
{{--                                                            Recommended--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
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
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="{{ route('shop_product.list', ['id' => $product->category->id, 'type' => 'category']) }}"
                                                       class="product-category">{{ $product->category->name }}</a>
                                                </div>
                                            </div>
                                            <h3 class="product-title">
                                                <a
                                                    href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">{{ $product->name }}</a>
                                            </h3>
                                            <!-- End .product-container -->

                                            @if ($product->discount_amount !=null || $product->discount_amount >0 )
                                                <div class="price-box">
                                                    <span class="old-price">{{ number_format($product->regular_price) }} tk</span>
                                                    <span class="product-price">
                                                        {{ number_format($product->selling_price) }}
                                                        tk
                                                    </span>
                                                </div>
                                            @else
                                                <div class="price-box">
                                                <span class="product-price">
                                                        {{ number_format($product->regular_price) }} tk
                                                </span>
                                                </div>
                                        @endif
                                        <!-- End .price-box -->
                                        </div>
                                        <div>
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
                                            <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                <button class="btn btn-dark btn-sm">details</button>
                                            </a>
                                            <!--Compare-->
                                            <a href="{{ Auth::guard('customer')->check() ? route('compare.store', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-recycle"></i>
                                                </button>
                                            </a>
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endif
    <!--/====================Hot product section======================-->

    <!--================Recommendation for you product section==========-->

    @if($products->where('type', 4)->count() !=0)
    <section class="product-common-section">
        <div class="container">
            <div class="appear-animate" data-animation-name="fadeIn" data-animation-delay="200">
                <h2 class="section-title">
                   Recommended  for you
                </h2>
                <div class="products-container product-slider-tab rounded">
                    <!-- Tab Content for Products -->
                    <div class="tab-content">
                        <!-- All Products -->
                        <div class="tab-pane fade show active" id="all">
                            <div class="products-slider owl-carousel owl-theme nav-outer"
                                 data-owl-options="{
                                    'items' : 2,
                                    'nav': false,
                                    'margin': 0,
                                    'dots':true,
                                     'responsive': {
                                         '576': {
                                             'items': 3
                                         },
                                         '768': {
                                             'items': 3
                                         },
                                         '992': {
                                             'items': 6
                                         },
                                         '1080': {
                                             'items': 6
                                         },
                                         '1320': {
                                             'items': 6
                                         },
                                         '1400': {
                                             'items': 6
                                         },
                                         '1980': {
                                             'items': 10
                                         }
                                    }
                                }">
                                @foreach ($products->where('type', 4)  as $product)
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a
                                                href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                @if ($product->image)
                                                    <img src="{{ asset($product->image) }}" alt="product"  >
                                                @else
                                                    <img src="{{ asset('website')}}/assets/images/notfound/notfound.jpeg" alt="product">
                                                @endif
                                            </a>
                                            <div class="label-group">
{{--                                                @if ($product->type)--}}
{{--                                                    <div class="product-label label-hot">--}}
{{--                                                        @if ($product->type == 4)--}}
{{--                                                            Recommended--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
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
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="{{ route('shop_product.list', ['id' => $product->category->id, 'type' => 'category']) }}"
                                                       class="product-category">{{ $product->category->name }}</a>
                                                </div>
                                            </div>
                                            <h3 class="product-title">
                                                <a
                                                    href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">{{ $product->name }}</a>
                                            </h3>
                                            <!-- End .product-container -->

                                            @if ($product->discount_amount !=null || $product->discount_amount >0 )
                                                <div class="price-box">
                                                    <span class="old-price">{{ number_format($product->regular_price) }} tk</span>
                                                    <span class="product-price">
                                                        {{ number_format($product->selling_price) }}
                                                        tk
                                                    </span>
                                                </div>
                                            @else
                                                <div class="price-box">
                                                <span class="product-price">
                                                        {{ number_format($product->regular_price) }} tk
                                                </span>
                                                </div>
                                        @endif
                                        <!-- End .price-box -->
                                        </div>
                                        <div>
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
                                            <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                <button class="btn btn-dark btn-sm">details</button>
                                            </a>
                                            <!--Compare-->
                                            <a href="{{ Auth::guard('customer')->check() ? route('compare.store', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-recycle"></i>
                                                </button>
                                            </a>
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endif
    <!--/==========Recommendation for you product section==========-->

    @if($banners->where('banner_position',1)->count() != 0)
        <section class="product-common-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @foreach($banners->where('banner_position',1) as $banner)
                            <a href="{{$banner->image_url}}">
                            <div class="banner banner1 rounded" style="background-color: #d9e1e1;">
                                <figure>
                                    <img src="{{asset($banner->image)}}" alt="banner" class="w-full h-full object-cover">
                                </figure>
                            </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif

    <!--latest product section-->

    @if($products->where('type', 2)->count() !=0)
    <section class="product-common-section">
        <div class="container">
            <div class="appear-animate" data-animation-name="fadeIn" data-animation-delay="200">
                <h2 class="section-title">
                    Latest
                </h2>
                <div class="products-container product-slider-tab rounded">
                    <!-- Tab Content for Products -->
                    <div class="tab-content">
                        <!-- All Products -->
                        <div class="tab-pane fade show active" id="all">
                            <div class="products-slider owl-carousel owl-theme nav-outer"
                                 data-owl-options="{
                                    'dots': false,
                                    'nav': true,
                                    'margin': 0,
                                    'dots':true,
                                     'responsive': {
                                         '576': {
                                             'items': 3
                                         },
                                         '768': {
                                             'items': 3
                                         },
                                         '992': {
                                             'items': 6
                                         },
                                         '1080': {
                                             'items': 6
                                         },
                                         '1320': {
                                             'items': 6
                                         },
                                         '1400': {
                                             'items': 6
                                         },
                                         '1980': {
                                             'items': 10
                                         }
                                    }
                                }">
                                @foreach ($products->where('type', 2)  as $product)
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a
                                                href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                @if ($product->image)
                                                    <img src="{{ asset($product->image) }}" alt="product"  >
                                                @else
                                                    <img src="{{ asset('website')}}/assets/images/notfound/notfound.jpeg" alt="product">
                                                @endif
                                            </a>
                                            <div class="label-group">
{{--                                                @if ($product->type)--}}
{{--                                                    <div class="product-label label-hot">--}}
{{--                                                        @if ($product->type == 2)--}}
{{--                                                            Latest--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                @endif --}}
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
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="{{ route('shop_product.list', ['id' => $product->category->id, 'type' => 'category']) }}"
                                                       class="product-category">{{ $product->category->name }}</a>
                                                </div>
                                            </div>
                                            <h3 class="product-title">
                                                <a
                                                    href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">{{ $product->name }}</a>
                                            </h3>
                                            <!-- End .product-container -->

                                            @if ($product->discount_amount !=null || $product->discount_amount >0 )
                                                <div class="price-box">
                                                    <span class="old-price">{{ number_format($product->regular_price) }} tk</span>
                                                    <span class="product-price">
                                                        {{ number_format($product->selling_price) }}
                                                        tk
                                                    </span>
                                                </div>
                                            @else
                                                <div class="price-box">
                                                <span class="product-price">
                                                        {{ number_format($product->regular_price) }} tk
                                                </span>
                                                </div>
                                        @endif
                                        <!-- End .price-box -->
                                        </div>
                                        <div>
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
                                            <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                <button class="btn btn-dark btn-sm">details</button>
                                            </a>
                                            <!--Compare-->
                                            <a href="{{ Auth::guard('customer')->check() ? route('compare.store', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-recycle"></i>
                                                </button>
                                            </a>
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endif
    <!--/latest product section-->

    <!-- popular product section-->

    @if($products->where('type', 3)->count() !=0)
    <section class="product-common-section">
        <div class="container">
            <!-- Most Popular Products section -->
            <div class="appear-animate" data-animation-name="fadeIn" data-animation-delay="200">
                <h2 class="section-title">Popular</h2>
                <div class="products-container product-slider-tab rounded">

                    <!-- Tab Content for Products -->
                    <div class="tab-content">
                        <!-- Products by Category -->
                        <div class="tab-pane fade show active" id="all">
                            <div class="products-slider owl-carousel owl-theme nav-outer"
                                 data-owl-options="{
                                    'dots': false,
                                    'nav': true,
                                    'margin': 0,
                                    'dots':true,
                                     'responsive': {
                                         '576': {
                                             'items': 3
                                         },
                                         '768': {
                                             'items': 3
                                         },
                                         '992': {
                                             'items': 6
                                         },
                                         '1080': {
                                             'items': 6
                                         },
                                         '1320': {
                                             'items': 6
                                         },
                                         '1400': {
                                             'items': 6
                                         },
                                         '1980': {
                                             'items': 10
                                         }
                                    }
                                }">
                                    @foreach ($products->where('type',3) as $product)
                                        <div class="product-default inner-quickview inner-icon pro_sec">
                                            <figure>
                                                <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                    @if ($product->image)
                                                        <img src="{{ asset($product->image) }}" style="height: 190px; width:100%;" width="217" height="217" alt="{{ $product->name }}">
                                                    @else
                                                        <img src="{{ asset('website')}}/assets/images/notfound/notfound.jpeg" style="height: 190px; width:100%;" width="217" height="217" alt="not found">
                                                    @endif
                                                </a>
                                                <div class="label-group">
{{--                                                    @if ($product->type)--}}
{{--                                                        <div class="product-label label-hot">--}}
{{--                                                            @if ($product->type == 3)--}}
{{--                                                                Popular--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    @endif --}}
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
                                                <div class="category-wrap">
                                                    <div class="category-list">
                                                        <a href="{{ route('shop_product.list', ['id' => $product->category->id, 'type' => 'category']) }}"
                                                           class="product-category">{{ $product->category->name }}</a>
                                                    </div>
                                                </div>
                                                <h3 class="product-title">
                                                    <a
                                                        href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">{{ $product->name }}</a>
                                                </h3>

                                                @if ($product->discount_amount !=null || $product->discount_amount >0 )
                                                    <div class="price-box">
                                                        <span class="old-price">{{ number_format($product->regular_price) }} tk</span>
                                                        <span class="product-price">
                                                            {{ number_format($product->selling_price) }}
                                                            tk
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="price-box">
                                                        <span class="product-price">
                                                                {{ number_format($product->regular_price) }} tk
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                            @php
                                                $customer_id = Auth::guard('customer')->id();
                                                $product_id = $product->id;
                                            @endphp
                                            <!-- wishlist -->
                                                <a
                                                    href="{{ Auth::guard('customer')->check() ? route('wishlist.add', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fas fa-heart"></i>
                                                    </button>
                                                </a>
                                                <!--details-->
                                                <a
                                                    href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                    <button class="btn btn-dark btn-sm">details</button>
                                                </a>
                                                <!--Compare-->
                                                <a
                                                    href="{{ Auth::guard('customer')->check() ? route('compare.store', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fas fa-recycle"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
{{--    <section class="popular-section">--}}
{{--        <div class="container">--}}
{{--            <!-- Most Popular Products section -->--}}
{{--            <div class="appear-animate" data-animation-name="fadeIn" data-animation-delay="200">--}}
{{--                <h2 class="section-title">Popular</h2>--}}
{{--                <div class="products-container product-slider-tab rounded">--}}
{{--                    <!-- Categories as Tabs -->--}}
{{--                    <ul class="nav nav-tabs border-0 px-4 pb-0 m-b-3">--}}
{{--                        @foreach ($categories as $key => $category)--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link {{ $key == 0 ? 'active' : '' }}" data-toggle="tab"--}}
{{--                                   href="#category-{{ $category->id }}">--}}
{{--                                    {{ $category->name }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}

{{--                    <!-- Tab Content for Products -->--}}
{{--                    <div class="tab-content">--}}
{{--                        <!-- Products by Category -->--}}
{{--                        @foreach ($categories as $key => $category)--}}
{{--                            <div class="tab-pane fade {{ $key == 0 ? 'active show' : '' }}"--}}
{{--                                 id="category-{{ $category->id }}">--}}
{{--                                <div class="products-slider owl-carousel owl-theme nav-outer"--}}
{{--                                     data-owl-options="{--}}
{{--                                        'dots': false,--}}
{{--                                        'nav': true,--}}
{{--                                        'margin': 0,--}}
{{--                                        'responsive': {--}}
{{--                                            '576': { 'items': 3 },--}}
{{--                                            '768': { 'items': 4 },--}}
{{--                                            '1200': { 'items': 6 }--}}
{{--                                        }--}}
{{--                                    }">--}}
{{--                                    @foreach ($category->products as $product)--}}
{{--                                        <div class="product-default inner-quickview inner-icon pro_sec">--}}
{{--                                            <figure>--}}
{{--                                                <a--}}
{{--                                                    href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">--}}
{{--                                                    @if ($product->image)--}}
{{--                                                        <img src="{{ asset($product->image) }}" style="height: 190px; width:100%;" width="217" height="217" alt="{{ $product->name }}">--}}
{{--                                                    @else--}}
{{--                                                        <img src="{{ asset('website')}}/assets/images/notfound/notfound.jpeg" style="height: 190px; width:100%;" width="217" height="217" alt="not found">--}}
{{--                                                    @endif--}}
{{--                                                </a>--}}
{{--                                                <div class="label-group">--}}
{{--                                                    @if ($product->type)--}}
{{--                                                        <div class="product-label label-hot">--}}
{{--                                                            @if ($product->type == 1)--}}
{{--                                                                HOT--}}
{{--                                                            @elseif ($product->type == 2)--}}
{{--                                                                LATEST--}}
{{--                                                            @elseif ($product->type == 3)--}}
{{--                                                                POPULAR--}}
{{--                                                            @endif--}}
{{--                                                        </div>--}}
{{--                                                    @endif--}}
{{--                                                    @if ($product->discount_type == 'percentage' )--}}
{{--                                                        <div class="product-label label-sale">--}}
{{--                                                            {{ $product->discount_amount }}%</div>--}}
{{--                                                    @elseif ($product->discount_type == 'flat' )--}}
{{--                                                        <div class="product-label label-sale">--}}
{{--                                                            {{ $product->discount_amount }}tk off</div>--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}

{{--                                            </figure>--}}
{{--                                            <div class="product-details">--}}
{{--                                                <div class="category-wrap">--}}
{{--                                                    <div class="category-list">--}}
{{--                                                        <a href="{{ route('shop_product.list', ['id' => $product->category->id, 'type' => 'category']) }}"--}}
{{--                                                           class="product-category">{{ $product->category->name }}</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <h3 class="product-title">--}}
{{--                                                    <a--}}
{{--                                                        href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">{{ $product->name }}</a>--}}
{{--                                                </h3>--}}

{{--                                                @if ($product->discount_amount !=null || $product->discount_amount >0 )--}}
{{--                                                    <div class="price-box">--}}
{{--                                                        <span class="old-price">{{ number_format($product->regular_price) }} tk</span>--}}
{{--                                                        <span class="product-price">--}}
{{--                                                            {{ number_format($product->selling_price) }}--}}
{{--                                                            tk--}}
{{--                                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                @else--}}
{{--                                                    <div class="price-box">--}}
{{--                                                        <span class="product-price">--}}
{{--                                                                {{ number_format($product->regular_price) }} tk--}}
{{--                                                        </span>--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                            <div>--}}
{{--                                            @php--}}
{{--                                                $customer_id = Auth::guard('customer')->id();--}}
{{--                                                $product_id = $product->id;--}}
{{--                                            @endphp--}}
{{--                                            <!-- wishlist -->--}}
{{--                                                <a--}}
{{--                                                    href="{{ Auth::guard('customer')->check() ? route('wishlist.add', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">--}}
{{--                                                    <button class="btn btn-primary btn-sm">--}}
{{--                                                        <i class="fas fa-heart"></i>--}}
{{--                                                    </button>--}}
{{--                                                </a>--}}
{{--                                                <!--details-->--}}
{{--                                                <a--}}
{{--                                                    href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">--}}
{{--                                                    <button class="btn btn-dark btn-sm">details</button>--}}
{{--                                                </a>--}}
{{--                                                <!--Compare-->--}}
{{--                                                <a--}}
{{--                                                    href="{{ Auth::guard('customer')->check() ? route('compare.store', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">--}}
{{--                                                    <button class="btn btn-primary btn-sm">--}}
{{--                                                        <i class="fas fa-recycle"></i>--}}
{{--                                                    </button>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!--/ popular product section-->
    <!--/ Banner section-->

    @if($banners->where('banner_position', 2)->count() > 0)
    <section class="product-common-section mb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach($banners->where('banner_position',2) as $banner)
                        <a href="{{$banner->image_url}}">
                            <div class="banner banner1 rounded " style="background-color: #d9e1e1;">

                                <figure>
                                    <img src="{{ asset($banner->image) }}" alt="banner" class="w-full h-full object-cover">

                                </figure>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
    <!--/ Banner section-->

    <!--============= Deal prime picks section============-->

    @if($products->where('type', 5)->count() !=0)
    <section class="product-common-section">
        <div class="container">
            <div class="appear-animate" data-animation-name="fadeIn" data-animation-delay="200">
                <h2 class="section-title">
                    DealPrime Picks
                </h2>
                <div class="products-container product-slider-tab rounded">
                    <!-- Tab Content for Products -->
                    <div class="tab-content">
                        <!-- All Products -->
                        <div class="tab-pane fade show active" id="all">
                            <div class="products-slider owl-carousel owl-theme nav-outer"
                                 data-owl-options="{
                                    'dots': false,
                                    'nav': true,
                                    'margin': 0,
                                    'dots':true,
                                     'responsive': {
                                         '576': {
                                             'items': 3
                                         },
                                         '768': {
                                             'items': 3
                                         },
                                         '992': {
                                             'items': 6
                                         },
                                         '1080': {
                                             'items': 6
                                         },
                                         '1320': {
                                             'items': 6
                                         },
                                         '1400': {
                                             'items': 6
                                         },
                                         '1980': {
                                             'items': 10
                                         }
                                    }
                                }">
                                @foreach ($products->where('type', 5)  as $product)
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a
                                                href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                @if ($product->image)
                                                    <img src="{{ asset($product->image) }}" alt="product"  >
                                                @else
                                                    <img src="{{ asset('website')}}/assets/images/notfound/notfound.jpeg" alt="product">
                                                @endif
                                            </a>
                                            <div class="label-group">
{{--                                                @if ($product->type)--}}
{{--                                                    <div class="product-label label-hot">--}}
{{--                                                        @if ($product->type == 5)--}}
{{--                                                            Dealprime--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
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
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="{{ route('shop_product.list', ['id' => $product->category->id, 'type' => 'category']) }}"
                                                       class="product-category">{{ $product->category->name }}</a>
                                                </div>
                                            </div>
                                            <h3 class="product-title">
                                                <a
                                                    href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">{{ $product->name }}</a>
                                            </h3>
                                            <!-- End .product-container -->

                                            @if ($product->discount_amount !=null || $product->discount_amount >0 )
                                                <div class="price-box">
                                                    <span class="old-price">{{ number_format($product->regular_price) }} tk</span>
                                                    <span class="product-price">
                                                        {{ number_format($product->selling_price) }}
                                                        tk
                                                    </span>
                                                </div>
                                            @else
                                                <div class="price-box">
                                                <span class="product-price">
                                                        {{ number_format($product->regular_price) }} tk
                                                </span>
                                                </div>
                                        @endif
                                        <!-- End .price-box -->
                                        </div>
                                        <div>
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
                                            <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                <button class="btn btn-dark btn-sm">details</button>
                                            </a>
                                            <!--Compare-->
                                            <a href="{{ Auth::guard('customer')->check() ? route('compare.store', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-recycle"></i>
                                                </button>
                                            </a>
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endif

    <!--/============= Deal prime picks section===========-->

    <!--=============Feature section==============-->

    @if($products->where('type', 6)->count() !=0)
    <section class="product-common-section">
        <div class="container">
            <div class="appear-animate" data-animation-name="fadeIn" data-animation-delay="200">
                <h2 class="section-title">
                    Featured
                </h2>
                <div class="products-container product-slider-tab rounded">
                    <!-- Tab Content for Products -->
                    <div class="tab-content">
                        <!-- All Products -->
                        <div class="tab-pane fade show active" id="all">
                            <div class="products-slider owl-carousel owl-theme nav-outer"
                                 data-owl-options="{
                                    'dots': false,
                                    'nav': true,
                                    'margin': 0,
                                    'dots':true,
                                    'responsive': {
                                         '576': {
                                             'items': 3
                                         },
                                         '768': {
                                             'items': 3
                                         },
                                         '992': {
                                             'items': 6
                                         },
                                         '1080': {
                                             'items': 6
                                         },
                                         '1320': {
                                             'items': 6
                                         },
                                         '1400': {
                                             'items': 6
                                         },
                                         '1980': {
                                             'items': 10
                                         }
                                    }
                                }">
                                @foreach ($products->where('type', 6)  as $product)
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a
                                                href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                @if ($product->image)
                                                    <img src="{{ asset($product->image) }}" alt="product"  >
                                                @else
                                                    <img src="{{ asset('website')}}/assets/images/notfound/notfound.jpeg" alt="product">
                                                @endif
                                            </a>
                                            <div class="label-group">
{{--                                                @if ($product->type)--}}
{{--                                                    <div class="product-label label-hot">--}}
{{--                                                        @if ($product->type == 6)--}}
{{--                                                            Feature--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
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
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="{{ route('shop_product.list', ['id' => $product->category->id, 'type' => 'category']) }}"
                                                       class="product-category">{{ $product->category->name }}</a>
                                                </div>
                                            </div>
                                            <h3 class="product-title">
                                                <a
                                                    href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">{{ $product->name }}</a>
                                            </h3>
                                            <!-- End .product-container -->

                                            @if ($product->discount_amount !=null || $product->discount_amount >0 )
                                                <div class="price-box">
                                                    <span class="old-price">{{ number_format($product->regular_price) }} tk</span>
                                                    <span class="product-price">
                                                        {{ number_format($product->selling_price) }}
                                                        tk
                                                    </span>
                                                </div>
                                            @else
                                                <div class="price-box">
                                                <span class="product-price">
                                                        {{ number_format($product->regular_price) }} tk
                                                </span>
                                                </div>
                                        @endif
                                        <!-- End .price-box -->
                                        </div>
                                        <div>
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
                                            <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                <button class="btn btn-dark btn-sm">details</button>
                                            </a>
                                            <!--Compare-->
                                            <a href="{{ Auth::guard('customer')->check() ? route('compare.store', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-recycle"></i>
                                                </button>
                                            </a>
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @endif
    <!--/ ============Feature section============-->
    <!--Banner section-->

    @if($banners->where('banner_position', 3)->count() > 0)
        <section class="product-common-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @foreach($banners->where('banner_position',3) as $banner)
                            <a href="{{$banner->image_url}}">
                                <div class="banner banner1 rounded " style="background-color: #d9e1e1;">
                                    <figure>
                                        <img src="{{asset($banner->image)}}" alt="banner" class="w-full h-full object-cover" >
                                    </figure>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--/ Banner section-->

    <!-- ========popular Categories section=======-->

    @if($categories->count() !=0)
    <section class="product-common-section">
        <div class="container">
            <!--populer Category  section-->
            <h2 class="section-title">Popular Categories</h2>
            <div class="categories-slider owl-carousel owl-theme mb-2 appear-animate"
                 data-owl-options="{
                     'items': 2,
                     'dots':true,
                     'responsive': {
                         '576': {
                             'items': 4
                         },
                         '768': {
                             'items': 4
                         },
                         '992': {
                             'items': 6
                         },
                         '1080': {
                             'items': 5
                         },
                         '1320': {
                             'items': 5
                         },
                         '1400': {
                             'items': 5
                         },
                         '1980': {
                             'items': 10
                         }
                     }
                 }"
                 data-animation-name="fadeInUpShorter" data-animation-delay="200">
                @foreach ($categories as $category)
                    <div class=" row ">
                        <a class="pro_sec-2" href="{{ route('shop_product.list', ['id' => $category->id, 'type' => 'category']) }}">
                            <div class="col-md-12 ">
                                <figure>
                                    @if ($category->image)
                                        <img src="{{ asset($category->image)}}" alt="cat" style="height: 180px" width="341" height="200">
                                    @else
                                        <img src="{{ asset('website')}}/assets/images/notfound/notfound.jpeg" alt="cat" style="height: 180px" width="341" height="200">
                                    @endif
                                </figure>
                            </div>
                            <div class="col-md-12">
                                <div class=" ">
                                    <h5 class=" ls-n-25">{{ $category->name }}</h5>
                                    {{--                                    <span class="font2 ls-n-20">{{ $category->products_count }} Products</span>--}}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    <!--/ =========popular Categories sectio========n-->
    <!--============ Combo product section================-->

    <!--@if($combo_products->count() != 0)-->
    <!--    <section class="product-common-section">-->
    <!--    <div class="container">-->
    <!--        security purpus-->
    <!--        Combo products-->
    <!--        <div class="appear-animate" data-animation-name="fadeIn" data-animation-delay="200">-->
    <!--            <h2 class="section-title">-->
    <!--                Combo Products-->
    <!--            </h2>-->
    <!--            <div class="products-container product-slider-tab rounded">-->
    <!--                 Tab Content for Products -->
    <!--                <div class="tab-content">-->
    <!--                     All Products -->
    <!--                    <div class="tab-pane fade show active" id="all">-->
    <!--                        <div class="products-slider owl-carousel owl-theme nav-outer"-->
    <!--                             data-owl-options="{-->
    <!--                                'dots': false,-->
    <!--                                'nav': true,-->
    <!--                                'margin': 0,-->
    <!--                                'responsive': {-->
    <!--                                    '576': { 'items': 3 },-->
    <!--                                    '768': { 'items': 4 },-->
    <!--                                    '1200': { 'items': 6 }-->
    <!--                                }-->
    <!--                            }">-->
    <!--                            @foreach ($combo_products as $c_product)-->
    <!--                                <div class="product-default inner-quickview inner-icon pro_sec" style="">-->
    <!--                                    <figure>-->
    <!--                                        <a href="{{ route('comboProduct.details', ['id' => $c_product->id]) }}">-->
    <!--                                            @if ($c_product->image)-->
    <!--                                                <img src="{{ asset($c_product->image) }}" style=" width:100%;background: transparent" alt="{{ $c_product->name }}">-->
    <!--                                            @else-->
    <!--                                                <img src="{{ asset('website')}}/assets/images/notfound/notfound.jpeg" style=" width:100%;background: transparent" alt="notfound">-->
    <!--                                            @endif-->
    <!--                                        </a>-->
    <!--                                        <div class="label-group">-->
    <!--                                            @if ($c_product->discount_type == 'percentage' )-->
    <!--                                                <div class="product-label label-sale">-->
    <!--                                                    {{ $c_product->discount_amount }}%</div>-->
    <!--                                            @elseif ($c_product->discount_type == 'flat' )-->
    <!--                                                <div class="product-label label-sale">-->
    <!--                                                    {{ $c_product->discount_amount }}tk off</div>-->
    <!--                                            @endif-->
    <!--                                        </div>-->
    <!--                                    </figure>-->
    <!--                                    <div class="product-details">-->


    <!--                                        <h3 class="product-title">-->
    <!--                                            <a href="{{ route('comboProduct.details', ['id' => $c_product->id]) }}">{{ $c_product->name }}</a>-->
    <!--                                        </h3>-->
    <!--                                        @if ($c_product->discount_amount !=null || $c_product->discount_amount >0 )-->
    <!--                                            <div class="price-box">-->
    <!--                                                <span class="old-price">{{ number_format($c_product->regular_price) }}-->
    <!--                                                    tk</span>-->
    <!--                                                <span class="product-price">-->
    <!--                                                        {{ number_format($c_product->selling_price) }}-->
    <!--                                                        tk-->
    <!--                                                </span>-->
    <!--                                            </div>-->
    <!--                                        @else-->
    <!--                                            <div class="price-box">-->
    <!--                                            <span class="product-price">-->
    <!--                                                {{ number_format($c_product->regular_price) }} tk-->
    <!--                                            </span>-->
    <!--                                            </div>-->
    <!--                                        @endif-->
    <!--                                    </div>-->
    <!--                                    <div>-->
    <!--                                        <a class="w-100 " href="{{ route('comboProduct.details', ['id' => $c_product->id]) }}">-->
    <!--                                            <button class="btn btn-dark btn-sm w-100 ">details</button>-->
    <!--                                        </a>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            @endforeach-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--    </div>-->
    <!--</section>-->
    <!--@endif-->

    <!--/ ================Combo product section=========-->

    <!--/ Seasonal Favourite section-->

    @if($products->where('type',7)->count() != 0)
    <section class="product-common-section">
        <div class="container">
            <div class="appear-animate" data-animation-name="fadeIn" data-animation-delay="200">
                <h2 class="section-title">
                    Seasonal Favourites
                </h2>
                <div class="products-container product-slider-tab rounded">
                    <!-- Tab Content for Products -->
                    <div class="tab-content">
                        <!-- All Products -->
                        <div class="tab-pane fade show active" id="all">
                            <div class="products-slider owl-carousel owl-theme nav-outer"
                                 data-owl-options="{
                                    'dots': true,
                                    'nav': true,
                                    'margin': 0,
                                    'responsive': {
                                        '576': { 'items': 3 },
                                        '768': { 'items': 4 },
                                        '1200': { 'items': 6 }
                                    }
                                }">
                                @foreach ($products->where('type', 7)  as $product)
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a
                                                href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                @if ($product->image)
                                                    <img src="{{ asset($product->image) }}" alt="product"  >
                                                @else
                                                    <img src="{{ asset('website')}}/assets/images/notfound/notfound.jpeg" alt="product">
                                                @endif
                                            </a>
                                            <div class="label-group">
{{--                                                @if ($product->type)--}}
{{--                                                    <div class="product-label label-hot">--}}
{{--                                                        @if ($product->type == 7)--}}
{{--                                                            seasonal--}}
{{--                                                        @endif--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}
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
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="{{ route('shop_product.list', ['id' => $product->category->id, 'type' => 'category']) }}"
                                                       class="product-category">{{ $product->category->name }}</a>
                                                </div>
                                            </div>
                                            <h3 class="product-title">
                                                <a
                                                    href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">{{ $product->name }}</a>
                                            </h3>
                                            <!-- End .product-container -->

                                            @if ($product->discount_amount !=null || $product->discount_amount >0 )
                                                <div class="price-box">
                                                    <span class="old-price">{{ number_format($product->regular_price) }} tk</span>
                                                    <span class="product-price">
                                                        {{ number_format($product->selling_price) }}
                                                        tk
                                                    </span>
                                                </div>
                                            @else
                                                <div class="price-box">
                                                <span class="product-price">
                                                        {{ number_format($product->regular_price) }} tk
                                                </span>
                                                </div>
                                        @endif
                                        <!-- End .price-box -->
                                        </div>
                                        <div>
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
                                            <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                <button class="btn btn-dark btn-sm">details</button>
                                            </a>
                                            <!--Compare-->
                                            <a href="{{ Auth::guard('customer')->check() ? route('compare.store', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-recycle"></i>
                                                </button>
                                            </a>
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--/ Seasonal Favourite section-->
    @endif


      <!--/ Banner section 4-->

    @if($banners->where('banner_position',4)->count() != 0)
    <section class="product-common-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach($banners->where('banner_position',4) as $banner)
                        <a href="{{$banner->image_url}}">
                        <div class="banner banner1 rounded  " style="background-color: #d9e1e1;">
                            <figure >
                                <img src="{{asset($banner->image)}}" alt="banner"  class="w-full h-full object-cover">
                            </figure>
                        </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
    <!--/ Banner section-->

    <!--Brand section-->

    @if($brands->count() != 0)
    <section class="brands-section">
        <div class="container">
            <div class="appear-animate" data-animation-name="fadeInUpShorter" data-animation-delay="100">
                <h2 class="section-title">Brands</h2>
            </div>

            <div class="slider-wrapper bg-white rounded appear-animate" data-animation-name="fadeInUpShorter"
                data-animation-delay="300">
                <div class="brands-slider owl-carousel owl-theme nav-outer"
                    data-owl-options="{
                         'navText': ['<i class=icon-angle-left>', '<i class=icon-angle-right>'],
                         'center': true,
                         'loop': true,
                         'nav': true,
                         'items': 2,
                         'responsive': {
                            '375': {
                                'nav': false,
                                'items': 3
                            },
                            '576': {
                                'navText': true,
                                'items': 3
                            },
                            '768': {
                                'items': 4
                            },
                             '992': {
                                 'items': 6
                             },
                             '1200': {
                                 'items': 8
                             }
                         }
                     }">
                    @foreach ($brands as $brand)
                        <div class="d-inline-block">
                            <img src="{{ asset($brand->image) }}" alt="brand" style="width: 80px!important;height: 70px!important" >
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
    <!--/Brand section-->

    <!--News letter popup-->
@if($popUp)
    <div class="newsletter-popup mfp-hide" id="newsletter-popup-form">
        <a href="{{$popUp->image_link}}" target="_blank">
            <div class="newsletter-popup-content">
                <img src="{{ asset($popUp->image) }}" alt="">
            </div>
        </a>
        <!-- End .newsletter-popup-content -->
    </div>

    <!--<button title="Close (Esc)" type="button" class="mfp-close">-->
    <!--    ×-->
    <!--</button>-->
    <!-- End .newsletter-popup -->
@endif

@endsection
