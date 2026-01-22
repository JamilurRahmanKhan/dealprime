<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li><a href="{{ route('home') }}">Home</a></li>

                <li>
                    <a href="#">Categories <span class="mmenu-btn"><i class="fas fa-angle-down"></i></span></a>
                    <ul>
                        <li><a href="{{ route('shop_product.list', 'all_product') }}">All Products</a></li>
                        {{-- Category --}}
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('shop_product.list', ['id' => $category->id, 'type' => 'category']) }}" class="nolink">
                                    {{ $category->name }}
                                    @if ($category->subCategory->count() > 0)
                                        <span class="mmenu-btn"><i class="fas fa-angle-down"></i></span>
                                    @endif
                                </a>
                                {{-- Subcategory --}}
                                @if ($category->subCategory->count() > 0)
                                    <ul>
                                        @foreach ($category->subCategory as $subCategory)
                                            <li>
                                                @php
                                                    // Fetch sub-subcategories
                                                    $subSubCategories = $category->sub_subcategory
                                                        ->where('sub_category_id', $subCategory->id)
                                                        ->where('status', 1);
                                                @endphp
                                                <a href="{{ route('shop_product.list', ['id' => $subCategory->id, 'type' => 'subcategory']) }}">
                                                    {{ $subCategory->name }}
                                                    @if ($subSubCategories->count() > 0)
                                                        <span class="mmenu-btn"><i class="fas fa-angle-down"></i></span>
                                                    @endif
                                                </a>
                                                {{-- Sub-Subcategory --}}
                                                @if ($subSubCategories->count() > 0)
                                                    <ul>
                                                        @foreach ($subSubCategories as $subSubCategory)
                                                            <li><a href="{{ route('shop_product.list', ['id' => $subSubCategory->id, 'type' => 'sub_subcategory']) }}">{{ $subSubCategory->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li><a href="{{route('about') }}">About</a></li>
                <li><a href="{{route('shop_product.list', 'all_product') }}">Shop</a></li>
                <!--<li><a href="{{route('shop_product.list', 'combo_product') }}">Combo Products</a></li>-->
                <li><a href="{{route('shop_product.list', 'discount_product') }}">Flash Sale</a></li>
                <li><a href="{{route('store.list')}}">Partners</a></li>
                <li><a href="{{route('contact') }}">Contact</a></li>

            </ul>
            <ul class="mobile-menu">
                <li><a href="{{ route('customer.login') }}">Customer Register</a></li>
                <li><a href="{{ route('merchant.apply') }}">Become a Partner</a></li>
            </ul>
        </nav>
        <!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank">
            </a>
            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank">
            </a>
            <a href="#" class="social-icon social-instagram icon-instagram" target="_blank">
            </a>
        </div>
    </div>
    <!-- End .mobile-menu-wrapper -->
</div>
<!-- End .mobile-menu-container -->

{{--<div class="sticky-navbar">--}}
{{--    <div class="sticky-info">--}}
{{--        <a href="{{ route('home') }}">--}}
{{--            <i class="icon-home"></i>Home--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="sticky-info">--}}
{{--        <a href="#" class="">--}}
{{--            <i class="icon-bars mobile-menu-toggler pt-2"></i>Categories--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="sticky-info">--}}
{{--        <a href="{{ route('wishlist') }}" class="">--}}
{{--            <i class="icon-wishlist-2"></i>Wishlist--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="sticky-info">--}}
{{--        <a href="{{ route('customer.dashboard') }}" class="">--}}
{{--            <i class="icon-user-2"></i>Account--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="sticky-info">--}}
{{--        <a href="cart.html" title="Cart" class="dropdown-toggle cart-toggle" role="button" data-toggle="dropdown"--}}
{{--            aria-haspopup="true" aria-expanded="false" data-display="static">--}}
{{--            <i class="icon-shopping-cart position-relative">--}}
{{--                <span class="cart-count badge-circle">{{ Cart::count() }}</span>--}}
{{--            </i>Cart--}}
{{--        </a>--}}
{{--    </div>--}}
{{--</div>--}}
