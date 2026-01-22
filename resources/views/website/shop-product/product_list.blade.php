@extends('website.layouts.master')
@section('title', 'Product List ')
@section('body')
    <style>
        /* Range slider styles */
        .range-slider {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .slider {
            -webkit-appearance: none;
            appearance: none;
            width: 95%;
            height: 8px;
            background: #ddd;
            border-radius: 5px;
            outline: none;
            cursor: pointer;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            background: #007bff;
            border-radius: 50%;
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 20px;
            height: 20px;
            background: #007bff;
            border-radius: 50%;
            cursor: pointer;
        }

        .price-inputs {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .price-input {
            width: 80px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }
    </style>
    <main class="main">
        <div class="container">
            {{-- <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="demo4.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Men</a></li>
                <li class="breadcrumb-item active" aria-current="page">Accessories</li>
            </ol>
        </nav> --}}
            <!--<div class="widget mobile-filter">-->
            <!--    <h3 class="widget-title">-->
            <!--        <a data-toggle="collapse" href="#widget-body-3" role="button">&nbsp;&nbsp;Filter by Price <i class="fas fa-angle-down"></i></a>-->
            <!--    </h3>-->
            <!--    <form action="{{route('searchProductByPrice')}}" method="post">-->
            <!--        @csrf-->
            <!--        <div class="collapse" id="widget-body-3">-->
            <!--            <div class="widget-body pb-0">-->
            <!--                <div id="filter-price-range">-->

            <!--                    <div class="range-slider">-->
                                    <!-- Slider -->
            <!--                        <input-->
            <!--                            type="range"-->
            <!--                            min="{{$minPrice}}"-->
            <!--                            max="{{$maxPrice}}"-->
            <!--                            value="0"-->
            <!--                            id="price-slider"-->
            <!--                            class="slider"-->
            <!--                        />-->

                                    <!-- Number Inputs -->
            <!--                        <div class="price-inputs">-->
            <!--                            <div>-->
            <!--                                <label for="min-price">Min:</label>-->
            <!--                                <input-->
            <!--                                    type="number"-->
            <!--                                    id="min-price"-->
            <!--                                    name="min_price"-->
            <!--                                    class="price-input"-->
            <!--                                    value="{{$minPrice}}"-->
            <!--                                    min="{{$minPrice}}"-->
            <!--                                    max="{{$maxPrice}}"-->
            <!--                                />-->
            <!--                            </div>-->
            <!--                            <div>-->
            <!--                                <label for="max-price">Max:</label>-->
            <!--                                <input-->
            <!--                                    type="number"-->
            <!--                                    id="max-price"-->
            <!--                                    name="max_price"-->
            <!--                                    class="price-input"-->
            <!--                                    value="{{$maxPrice}}"-->
            <!--                                    min="{{$minPrice}}"-->
            <!--                                    max="{{$maxPrice}}"-->
            <!--                                />-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->

            <!--                {{--                                    <input type="button" class="btn btn-primary btn-sm w-100 w-sm-50 w-md-100 mt-1 font2" onclick="searchProductByPriceList()" value="Filter">--}}-->
            <!--                <input type="submit" class="btn btn-primary btn-sm w-100 w-sm-100 w-md-100 mt-1 font2"  value="Filter" style="font-size: 15px;padding: 3px 7px;">-->
            <!--            {{--                                            <button type="submit" >Filter</button>--}}-->

                        <!-- End .filter-price-action -->

            <!--            </div>-->
                        <!-- End .widget-body -->
            <!--        </div>-->
            <!--    </form>-->
                <!-- End .collapse -->
            <!--</div>-->
            <div class="row">
                <div class="col-lg-9 main-content">
                    <div class="row">
                        @if ($products->count() != 0)
                            @foreach ($products as $product)
                                <div class="col-6 col-sm-4 col-md-3">
                                    <div class="product-default">
                                        <figure>
                                        @if (request()->segment(2) === 'combo_product' )
                                            <!-- Handle Combo Products -->
                                                <a href="{{ route('comboProduct.details', ['id' => $product->id]) }}">
                                                    @if ($product->image)
                                                        <img class="img-fluid" src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width:100%; height:190px;">
                                                    @else
                                                        <img class="img-fluid" src="{{ asset('website')}}/assets/images/notfound/notfound.jpeg" alt="not found" style="width:100%; height:190px;">
                                                    @endif
                                                </a>
                                        @else
                                            <!-- Handle Regular Products -->
                                                <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                    @if ($product->image)
                                                        <img class="img-fluid" src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width:100%; height:190px;">
                                                    @else
                                                        <img class="img-fluid" src="{{ asset('website')}}/assets/images/notfound/notfound.jpeg" alt="not found" style="width:100%; height:190px;">
                                                    @endif
                                                </a>
                                            @endif

                                            <div class="label-group">
{{--                                                @if ($product->type)--}}
{{--                                                    <div class="product-label label-hot">--}}
{{--                                                        @if ($product->type == 1)--}}
{{--                                                            HOT--}}
{{--                                                        @elseif ($product->type == 2)--}}
{{--                                                            LATEST--}}
{{--                                                        @elseif ($product->type == 3)--}}
{{--                                                            POPULAR--}}
{{--                                                        @elseif ($product->type == 4)--}}
{{--                                                            Recommendation for you--}}
{{--                                                        @elseif ($product->type == 5)--}}
{{--                                                            DealPrime picks--}}
{{--                                                        @elseif ($product->type == 6)--}}
{{--                                                            Feature--}}
{{--                                                        @elseif ($product->type == 7)--}}
{{--                                                            Seasonal Favourite--}}
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
                                                    @if ($product->category && $product->category->name)

                                                        <a href="{{ route('shop_product.list', ['id' => $product->category->id, 'type' => 'category']) }}"
                                                           class="product-category">{{ $product->category->name }}</a>
{{--                                                    @else--}}
{{--                                                        <a href="category.html" class="product-category">Combo product</a>--}}
                                                    @endif
                                                </div>
                                            </div>

                                            <h3 class="product-title">
                                                @if (request()->segment(2) === 'combo_product' )
                                                    <a href="{{route('comboProduct.details',['id'=>$product->id] )}}">{{$product->name}}</a>
                                                @else
                                                    <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">{{$product->name}}</a>
                                                @endif

                                            </h3>
                                            @if ($product->discount_amount !=null || $product->discount_amount >0 )
                                                <div class="price-box">
                                                    <span class="old-price">{{ number_format($product->regular_price) }}
                                                        tk</span>
                                                    <span class="product-price">
                                                            {{-- {{ number_format($product->regular_price - $product->regular_price * ($product->discount_amount / 100)) }}
                                                            tk --}}
                                                        {{ number_format($product->selling_price) }} tk
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

                                            @if (request()->segment(2) === 'combo_product' )
                                            <div class="product-action w-100">
                                                @else
                                            <div class="product-action">
                                            @endif
                                            @php
                                                $customer_id = Auth::guard('customer')->id();
                                                $product_id = $product->id;
                                            @endphp

                                            <!--details-->
                                                @if (request()->segment(2) === 'combo_product' )
                                                    <a href="{{route('comboProduct.details',['id'=>$product->id] )}}" >
                                                        <button class="btn btn-dark btn-sm w-100 w-md-100">details</button>
                                                    </a>
                                                @else
                                                <!-- wishlist -->
                                                    <a href="{{ Auth::guard('customer')->check() ? route('wishlist.add', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">
                                                        <button class="btn btn-primary btn-sm">
                                                            <i class="fas fa-heart"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product_item.details', ['id' => $product->id, 'category_id' => $product->category_id]) }}">
                                                        <button class="btn btn-dark btn-sm">details</button>
                                                    </a>
                                                    <!--Compare-->
                                                    <a href="{{ Auth::guard('customer')->check() ? route('compare.store', ['customer_id' => $customer_id, 'product_id' => $product_id]) : route('customer.login') }}">
                                                        <button class="btn btn-primary btn-sm">
                                                            <i class="fas fa-recycle"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- End .product-details -->
                                    </div>
                                </div>
                            @endforeach



                        <!-- End .col-sm-4 -->
                        @else
                            <div class="col-12 d-flex justify-content-center">
                                <div class="text-center">
                                    <img src="{{ asset('website') }}/assets/images/notfound/2002.gif"
                                         style="height: 200px" alt="">
                                </div>
                            </div>
                        @endif

                    </div>
                    <!-- End .row -->
                    <!--pagination--->
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div>
                                {{ $products->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>

                    <!--end pagination-->
                </div>
                <!-- End .col-lg-9 -->


                <div class="sidebar-overlay"></div>
{{--                    mobile-sidebar--}}
                <aside class="sidebar-shop col-lg-3 order-lg-first ">
                    <div class="sidebar-wrapper">
                        <!-- category -->
                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true"
                                   aria-controls="widget-body-2">Categories</a>
                            </h3>

                            <div class="collapse show" id="widget-body-2">
                                <div class="widget-body">
                                    <ul class="cat-list">
                                        @foreach ($categories as $category)
                                            @php
                                                $subcategories = \App\Models\SubCategory::where(
                                                    'category_id',
                                                    $category->id
                                                )->get();
                                            @endphp
                                            <li>

                                                <a href="{{route('shop_product.list', ['id' => $category->id, 'type' => 'category']) }}">
                                                    {{ $category->name }}
                                                </a>
                                                <a href="#widget-category-{{ $category->id }}" data-toggle="collapse"
                                                   role="button" aria-controls="widget-category-{{$category->id }}">
{{--                                                    <span class="products-count">({{$catProductCount}})</span>--}}
                                                    <span class="products-count">({{$category->subCategory->where('category_id',$category->id)->count()}})</span>
                                                    @if ($category->subCategory->where('category_id',$category->id)->count())
                                                        <span class="toggle"></span>
                                                    @endif
                                                </a>
                                                @if ($category->subCategory->where('category_id',$category->id)->count())
                                                    <div class="collapse" id="widget-category-{{$category->id }}">
                                                        <ul class="cat-sublist">
                                                            @foreach ($category->subCategory->where('category_id',$category->id) as $subcategory)
                                                                <li>
                                                                    <a href="{{route('shop_product.list', ['id' => $subcategory->id, 'type' => 'subcategory']) }}">
                                                                        {{ $subcategory->name }}
                                                                    </a>
                                                                    <a href="#widget-sub-category-{{ $subcategory->id }}" data-toggle="collapse"
                                                                       role="button">
                                                                        <span class="products-count">
                                                                            ({{$subcategory->subSubCategory->where('sub_category_id',$subcategory->id)->count()}})
                                                                        </span>
                                                                        @if ($subcategory->subSubCategory->where('sub_category_id',$subcategory->id)->count() !=0)
                                                                            <span class="toggle"></span>
                                                                        @endif
                                                                    </a>
                                                                    @if ($subcategory->subSubCategory->where('sub_category_id',$subcategory->id)->count())
                                                                        <div class="subSubcategory collapse" id="widget-sub-category-{{$subcategory->id }}">
                                                                            <ul class="cat-sublist">
                                                                                @foreach ($subcategory->subSubCategory->where('sub_category_id',$subcategory->id) as $subSubcategory)
                                                                                    <li data-bs-target="#widget-category-{{$subSubcategory->id}}">
                                                                                        <a href="{{route('shop_product.list', ['id' => $subSubcategory->id, 'type' => 'sub_subcategory']) }}">
                                                                                            {{ $subSubcategory->name }}
                                                                                        </a>
                                                                                    </li>
                                                                                    {{--                                                                $subcategories =$category->subCategory->where('category_id',$category->id)->get();--}}
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                </li>
{{--                                                                $subcategories =$category->subCategory->where('category_id',$category->id)->get();--}}
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        <!-- //category -->
                        <!--<div class="widget filter">-->
                        <!--    <h3 class="widget-title">-->
                        <!--        <a data-toggle="collapse" href="#widget-body-3" role="button">&nbsp;&nbsp;Filter by Price</a>-->
                        <!--    </h3>-->
                        <!--    <form action="{{route('searchProductByPrice')}}" method="post">-->
                        <!--        @csrf-->
                        <!--        <div class="collapse show" id="widget-body-3">-->
                        <!--            <div class="widget-body pb-0">-->
                        <!--                <div id="filter-price-range">-->

                        <!--                    <div class="range-slider">-->
                                                <!-- Slider -->
                        <!--                        <input-->
                        <!--                            type="range"-->
                        <!--                            min="{{$minPrice}}"-->
                        <!--                            max="{{$maxPrice}}"-->
                        <!--                            value="0"-->
                        <!--                            id="price-slider"-->
                        <!--                            class="slider"-->
                        <!--                        />-->

                                                <!-- Number Inputs -->
                        <!--                        <div class="price-inputs">-->
                        <!--                            <div>-->
                        <!--                                <label for="min-price">Min:</label>-->
                        <!--                                <input-->
                        <!--                                    type="number"-->
                        <!--                                    id="min-price"-->
                        <!--                                    name="min_price"-->
                        <!--                                    class="price-input"-->
                        <!--                                    value="{{$minPrice}}"-->
                        <!--                                    min="{{$minPrice}}"-->
                        <!--                                    max="{{$maxPrice}}"-->
                        <!--                                />-->
                        <!--                            </div>-->
                        <!--                            <div>-->
                        <!--                                <label for="max-price">Max:</label>-->
                        <!--                                <input-->
                        <!--                                    type="number"-->
                        <!--                                    id="max-price"-->
                        <!--                                    name="max_price"-->
                        <!--                                    class="price-input"-->
                        <!--                                    value="{{$maxPrice}}"-->
                        <!--                                    min="{{$minPrice}}"-->
                        <!--                                    max="{{$maxPrice}}"-->
                        <!--                                />-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                    </div>-->
                        <!--                </div>-->

                        <!--                {{--                                    <input type="button" class="btn btn-primary btn-sm w-100 w-sm-50 w-md-100 mt-1 font2" onclick="searchProductByPriceList()" value="Filter">--}}-->
                        <!--                <input type="submit" class="btn btn-primary btn-sm w-100 w-sm-50 w-md-100 mt-1 font2"  value="Filter">-->
                        <!--            {{--                                            <button type="submit" >Filter</button>--}}-->

                                    <!-- End .filter-price-action -->

                        <!--            </div>-->
                                    <!-- End .widget-body -->
                        <!--        </div>-->
                        <!--    </form>-->
                            <!-- End .collapse -->
                        <!--</div>-->
                        <!-- Price -->



                        <!-- //price -->
                        <!-- Color -->
                        <!--<div class="widget widget-color">-->
                        <!--    <h3 class="widget-title">-->
                        <!--        <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true"-->
                        <!--            aria-controls="widget-body-4">Color</a>-->
                        <!--    </h3>-->

                        <!--    <div class="collapse show" id="widget-body-4">-->
                        <!--        <div class="widget-body pb-0">-->
                        <!--            <ul class="config-swatch-list">-->
                    <!--                @foreach ($colors as $index => $color)-->
                    <!--                    <li class="{{ $index == 0 ? 'active' : '' }}">-->
                    <!--                        <a href="#" style="background-color: {{ $color->code }}"></a>-->
                        <!--                    </li>-->
                        <!--                @endforeach-->
                        <!--            </ul>-->
                        <!--        </div>-->
                        <!-- End .widget-body -->
                        <!--    </div>-->
                        <!-- End .collapse -->
                    </div>
                    <!-- //Color -->
                    <!-- Size -->
                    <!--<div class="widget widget-size">-->
                    <!--    <h3 class="widget-title">-->
                    <!--        <a data-toggle="collapse" href="#widget-body-5" role="button" aria-expanded="true"-->
                    <!--            aria-controls="widget-body-5">Sizes</a>-->
                    <!--    </h3>-->

                    <!--    <div class="collapse show" id="widget-body-5">-->
                    <!--        <div class="widget-body pb-0">-->
                    <!--            <ul class="config-size-list">-->
                <!--                @foreach ($sizes as $index => $size)-->
                <!--                    <li class="{{ $index == 0 ? 'active' : '' }}"><a-->
                <!--                            href="#">{{ $size->code }}</a></li>-->
                    <!--                @endforeach-->
                    <!--            </ul>-->
                    <!--        </div>-->
                    <!-- End .widget-body -->
                    <!--    </div>-->
                    <!-- End .collapse -->
                    <!--</div>-->
                    <!-- //Size -->
            </div>
            <!-- End .sidebar-wrapper -->
            </aside>
            <!-- End .col-lg-3 -->
        </div>
        <!-- End .row -->
        </div>
        <!-- End .container -->

        <div class="mb-4"></div>
        <!-- margin -->
    </main>
    <!-- End .main -->

    <script>
        const slider = document.getElementById("price-slider");
        const minInput = document.getElementById("min-price");
        const maxInput = document.getElementById("max-price");

        // Synchronize slider with number inputs
        slider.addEventListener("input", () => {
            const value = parseInt(slider.value);
            minInput.value = {{$minPrice}};
            maxInput.value = value;
        });

        // Update slider when max input changes
        maxInput.addEventListener("input", () => {
            const maxValue = parseInt(maxInput.value);


            if (maxValue > {{$maxPrice}}) maxInput.value = {{$maxPrice}}; // Cap at 10,000
            if (maxValue < parseInt(minInput.value)) maxInput.value = minInput.value;

            slider.value = maxValue;
        });

        // Update slider when min input changes (if necessary)
        minInput.addEventListener("input", () => {
            const minValue = parseInt(minInput.value);

            if (minValue < 0) minInput.value = 0; // Cap at 0
            if (minValue > parseInt(maxInput.value)) minInput.value = maxInput.value;

            slider.value = maxInput.value; // Keep the slider synced
        });

        // Initialize values
        // minInput.value = 0;
        // maxInput.value = 10000;
    </script>


@endsection
