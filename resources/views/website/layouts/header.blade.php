 <!--header top-->
 <div class="header-top c-d-none">
     <div class="container">
         <div class="header-left d-none d-xl-block">
             <div class="info-box info-box-icon-left p-0">
{{--                 <i class="icon-shipping text-primary"></i>--}}

                 <div class="info-box-content0">
{{--                     <h4 class="mb-0">FREE Express Shipping On Orders $99+</h4>--}}
                 </div>
                 <!-- End .info-box-content -->
             </div>
             <!-- End .info-box -->
         </div>
         <!-- End .header-left -->
         <div class="header-right header-dropdowns">
{{--             <div class="separator d-none d-lg-inline"></div>--}}

             <div class="header-dropdown dropdown-expanded d-none d-lg-block">
                 <a href="#">Links</a>
                 <div class="header-menu">
                     <ul>
                         <li>
                             <a href="{{route('merchant.apply')}}" class="pt-2">
                                <i class="fas fa-store" ></i> Become a Partner
                             </a>
                         </li>
                         <li>
                             <a href="{{route('contact')}}">
                                 <i class="icon-help-circle"></i> Help
                             </a>
                         </li>
                         <li>
                             <a href="{{ route('wishlist') }}">
                                 <i class="icon-wishlist-2"></i> Wishlist
                             </a>
                         </li>
                         <li>
                             <a href="{{route('compare')}}" class="pt-2">
                                <i class="fa fa-list-alt"></i> Compare
                             </a>
                         </li>
                     </ul>
                 </div>
             </div>

             <span class="separator d-none d-lg-inline"></span>

             <div class="social-icons">
                 <a href="{{$setting->facebook}}" class="social-icon social-facebook icon-facebook" target="_blank"></a>
                 <a href="{{$setting->instagram}}" class="social-icon social-instagram icon-instagram" target="_blank"></a>
                 <a href="{{$setting->twitter}}" class="social-icon social-twitter icon-twitter" target="_blank"></a>
             </div>
             <!-- End .social-icons -->
         </div>
         <!-- End .header-right -->
     </div>
     <!-- End .container -->
 </div>
 <!-- End .header-top -->

 <!--header Middle-->
 <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
     <div class="container">
         <div class="header-left w-lg-max">
             <button class="mobile-menu-toggler text-primary mr-2" type="button">
                 <i class="fas fa-bars"></i>
             </button>
             <a href="{{ route('home') }}" class="logo">
                 @if ($setting->logo_png)
                     <img src="{{ asset($setting->logo_png) }}" alt="Deal Prime" style="width: 200px">
                 @else
                     <img src="{{ asset('website') }}/assets/images/logo/DealPrimeLogo.png" alt="Deal Prime" style="width: 500px">
                 @endif
             </a>
             <div class="header-icon header-search header-search-inline header-search-category d-lg-block text-right mt-0 show d-block">
{{--                 <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>--}}

                     <div class="header-search-wrapper">
                         <input type="hidden" id="search_product_id" name="search_product_id">
                         <input type="search" class="form-control search_product_id" id="search_product" onkeyup="enableSearchButton()" required="required" autocomplete="on" placeholder="Enter your search product ...">
                         <!-- End .select-custom -->
                           <button class="btn  p-0" title="search" type="submit" disabled onclick="searchProductList()" id="search_button" style="color:white;font-size: 12px">Search</button>

                         <!--<button class="btn  p-0" title="search" type="submit" disabled onclick="searchProductList()" id="search_button" style="color:white;font-size: 12px">Search</button>-->
                     </div>

                     <!-- End .header-search-wrapper -->

             </div>
             <!-- End .header-search -->
         </div>
         <!-- End .header-left -->

{{--         <div class="">--}}
{{--             <div class="header-icon header-search header-search-inline header-search-category d-lg-block text-right mt-0 show d-none">--}}
{{--                 <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>--}}

{{--                 <div class="header-search-wrapper show">--}}
{{--                     <input type="hidden" id="search_product_id" name="search_product_id">--}}
{{--                     <input type="search" class="form-control search_product_id" onkeyup="searchProductList(this.value)" required="required" autocomplete="on" placeholder="Enter your search product ...">--}}
{{--                     <!-- End .select-custom -->--}}
{{--                     <button class="btn icon-magnifier p-0" title="search" type="submit" onclick="alert_message()"></button>--}}
{{--                 </div>--}}

{{--                 <!-- End .header-search-wrapper -->--}}

{{--             </div>--}}
{{--         </div>--}}

         <div class="header-right">

             <a href="{{route('wishlist')}}" class="header-icon position-relative d-lg-none mr-2">
                 <i class="icon-wishlist-2"></i>
                 <span class="badge-circle">{{$wishlistCount}}</span>
             </a>

             <div class="header-user d-lg-flex align-items-center">
                 <a href="{{ route('customer.dashboard') }}" class="header-icon mr-0" title="login"><i
                         class="icon-user-2 mr-2"></i></a>
                 @if (Auth::guard('customer')->check())
                     <h6 class="font1 d-none d-lg-block mb-0">
                         <span class="d-block text-body">Welcome</span>
                         <a href="{{ route('customer.dashboard') }}"
                             class="font-weight-bold">{{ Auth::guard('customer')->user()->name }}</a>
                     </h6>
                 @else
                     <h6 class="font1 d-none d-lg-block mb-0">
                         <span class="d-block text-body">Welcome</span>
                         <a href="{{ route('customer.login') }}" class="font-weight-bold">Sign In / Register</a>
                     </h6>
                 @endif
             </div>

             <div class="cart-dropdown-wrapper d-flex align-items-center">
                 <div class="dropdown cart-dropdown">
                     <a href="#" title="Cart" class="dropdown-toggle cart-toggle" role="button"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                         <i class="icon-cart-thick"></i>
                         <span class=" cart-count badge-circle">{{Cart::count()}}</span>
                     </a>

                     <div class="cart-overlay"></div>

                     <div class="dropdown-menu mobile-cart">
                         <a href="#" title="Close (Esc)" class="btn-close">×</a>

                         <div class="dropdownmenu-wrapper custom-scrollbar">
                             <div class="dropdown-cart-header">Shopping Cart</div>
                             <!-- End .dropdown-cart-header -->
                             @php $sum = 0; @endphp

                             @if (Cart::count() > 0)
                                 <div class="dropdown-cart-products">
                                     @foreach (Cart::content() as $cartItem)
                                         <div class="product">
                                             <div class="product-details">
                                                 <h4 class="product-title">
                                                     <a href="{{route('product_item.details',['id'=>$cartItem->id,'category_id'=>$cartItem->category_id])}}">{{ $cartItem->name }}</a>
                                                 </h4>

                                                 <span class="cart-product-info">
                                                     <span class="cart-product-qty">{{ $cartItem->qty }}</span> ×
                                                     {{ number_format($cartItem->price) }} tk
                                                 </span>
                                             </div>
                                             <!-- End .product-details -->

                                             <figure class="product-image-container">
                                                 <a href="#" class="product-image">
                                                     <img src="{{ asset($cartItem->options->image) }}" alt="product"
                                                         width="80" height="80">
                                                 </a>

                                                 <a href="{{ route('carts.rowDelete', ['rowId' => $cartItem->rowId]) }}"
                                                     class="btn-remove" title="Remove Product"><span>×</span></a>
                                             </figure>
                                         </div>

                                         @php
                                             $total_price = $cartItem->qty * $cartItem->price;
                                             $sum += $total_price;
                                         @endphp
                                     @endforeach
                                 </div>


                                 <div class="dropdown-cart-total">
                                     <span>SUBTOTAL:</span>
                                     <span class="cart-total-price float-right">{{ number_format($sum) }} tk</span>
                                 </div>
                                 <div class="dropdown-cart-action">
                                    <a href="{{ route('carts.index') }}" class="btn btn-gray btn-block view-cart">View
                                        Cart</a>
                                    <a href="{{ route('checkout') }}" class="btn btn-dark btn-block">Checkout</a>
                                </div>
                             @else
                                 <div>
                                    <img src="{{asset('website')}}/assets/images/notfound/cart_empty.gif" alt="">
                                 </div>
                             @endif
                             <!-- End .dropdown-cart-total -->



                             <!-- End .dropdown-cart-total -->
                         </div>
                         <!-- End .dropdownmenu-wrapper -->
                     </div>
                     <!-- End .dropdown-menu -->
                 </div>
                 <!-- End .dropdown -->

                 <span class="cart-subtotal font2 d-none d-sm-inline">Shopping Cart
                     <span class="cart-price d-block font2">{{ number_format($sum) }} tk</span>
                 </span>
             </div>
         </div>
         <!-- End .header-right -->
     </div>
     <!-- End .container -->
 </div>
 <!-- End .header-middle -->

 <!--header Bottom-->
 <div class="header-bottom sticky-header d-none d-lg-flex" data-sticky-options="{'mobile': false}">
     <div class="container">
         <div class="header-center w-100 ml-0">
             <nav class="main-nav d-flex font2">
                 <div class="menu-depart">
                     <a href="#"><i class="fa fa-bars align-middle mr-3"></i>All Categories</a>
                     <ul class="menu menu-vertical">
                         <li>
                             <a href="{{ route('shop_product.list', 'all_product') }}">All Product</a>
                         </li>
                         {{-- category --}}
                         @foreach ($categories as $category)
                             <li>
                                 <a href="{{ route('shop_product.list', ['id' => $category->id, 'type' => 'category']) }}">
                                     {{ $category->name }}</a>
                                 <span class="{{ count($category->subCategory) > 0 ? 'menu-btn' : '' }}"></span>
                                 @if (count($category->subCategory) > 0)
                                     <div class="megamenu megamenu-fixed-width megamenu-three">
                                         <div class="row">
                                             {{-- subcategory --}}
                                             @foreach ($category->subCategory as $subCategory)
                                                 <div class="col-lg-3 mb-1"  >
                                                     <a href="{{ route('shop_product.list', ['id' => $subCategory->id, 'type' => 'subcategory']) }}"
                                                         class="nolink">{{ $subCategory->name }}</a>

                                                     <ul class="submenu pb-0">
                                                         {{-- sub subcategory --}}
                                                         @php
                                                             $subSubCategories = $category->sub_subcategory
                                                                 ->where('sub_category_id', $subCategory->id)
                                                                 ->where('status', 1);
                                                         @endphp
                                                         @foreach ($subSubCategories as $subSubCategory)
                                                             <li >
                                                                <a href="{{ route('shop_product.list', ['id' => $subSubCategory->id, 'type' => 'sub_subcategory']) }}">
                                                                    {{ $subSubCategory->name }}
                                                                </a>
                                                             </li>
                                                         @endforeach

                                                     </ul>
                                                 </div>
                                             @endforeach
                                         </div>
                                         <!-- End .row -->
                                     </div>
                                 @endif
                                 <!-- End .megamenu -->
                             </li>
                         @endforeach
                     </ul>

                 </div>

                 <ul class="menu">
                     <li>
                         <a href="{{ route('home') }}">Home</a>
                     </li>
                     <li>
                         <a href="{{ route('faq') }}">FAQ</a>
                     </li>
                     <li>
                         <a href="{{ route('shop_product.list', 'all_product') }}">Shop</a>
                     </li>
                     <!--<li>-->
                     <!--    <a href="{{ route('shop_product.list', 'combo_product') }}">Combo Products</a>-->
                     <!--</li>-->
                     <li>
                         <a href="{{ route('shop_product.list', 'discount_product') }}">Flash Sale</a>

                     </li>
                     <li>
                         <a href="{{route('store.list')}}">Partners</a>
                     </li>

                     <li>
                         <a href="{{ route('contact') }}">Contact</a>
                     </li>


                 </ul>
             </nav>
{{--             <div class="info-boxes font2 align-items-center ml-auto">--}}
{{--                 <div class="info-item">--}}
{{--                     <a href="{{ route('shop_product.list', 'discount_product') }}">--}}
{{--                        <i class="icon-percent-shape"></i>Special Offers</a>--}}
{{--                 </div>--}}
{{--             </div>--}}
         </div>
         <div class="header-right"></div>
     </div>
 </div>
