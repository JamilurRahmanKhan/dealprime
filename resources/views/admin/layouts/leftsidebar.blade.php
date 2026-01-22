<div class="leftside-menu">

    <!-- Logo Light -->
    <a href="{{route('dashboard')}}" class="logo logo-light">
                <span class="logo-lg">
                    {{-- <img src="{{asset('/')}}admin/assets/images/gadget.jpg" alt="logo" class="w-75" height="70px"> --}}
                    <img src="{{ asset('website') }}/assets/images/logo/deal-head-logo.png" alt="logo"  width="100" >
                </span>
        <span class="logo-sm">
                    {{-- <img src="{{asset('/')}}admin/assets/images/gadget.jpg" alt="small logo" height="70px " width="70px"> --}}
                    <img src="{{ asset('website') }}/assets/images/logo/deal-head-logo.png" alt="small logo" width="100" >
                </span>
    </a>

    <!-- Logo Dark -->
    <a href="{{route('dashboard')}}" class="logo logo-dark">
                <span class="logo-lg">
                    <img src="{{asset('/')}}admin/assets/images/gadget.jpg" alt="dark logo" height="22">
                </span>
        <span class="logo-sm">
                    <img src="{{asset('/')}}admin/assets/images/gadget.jpg" alt="small logo" height="22">
                </span>
    </a>
    <!-- Sidebar Hover Menu Toggle Button -->
    <button type="button" class="btn button-sm-hover p-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </button>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user">
            <a href="pages-profile.html">
                <img src="{{asset('/')}}admin/assets/images/users/avatar-1.jpg" alt="user-image" height="42"
                     class="rounded-circle shadow-sm">
                <span class="leftbar-user-name">Dominic Keller</span>
            </a>
        </div>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Menu</li>
            <!---Dashboard---->
            @can('dashboard')
                <li class="side-nav-item">
                    <a href="{{route('dashboard')}}" class="side-nav-link">
                        <i class="uil-home-alt"></i>
                        <span> Dashboards </span>
                    </a>
                </li>
            @endcan

        <!---Role Module--->
            @if(auth()->user()->can('role.index') || auth()->user()->can('role.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#role" aria-expanded="false"
                       aria-controls="role" class="side-nav-link">
                        <i class="fa-solid fa-user-gear"></i>
                        <span> Role Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="role">
                        <ul class="side-nav-second-level">
                            @can('role.create')
                                <li>
                                    <a href="{{route('role.create')}}">Add Role</a>
                                </li>
                            @endcan
                            @can('role.index')
                                <li>
                                    <a href="{{route('role.index')}}">Manage Role</a>
                                </li>
                            @endcan


                        </ul>
                    </div>
                </li>
            @endif
        <!--- User Module--->
            @if(auth()->user()->can('user.index') || auth()->user()->can('user.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#user" aria-expanded="false"
                       aria-controls="user" class="side-nav-link">
                        <i class="fa-solid fa-user-group"></i>
                        <span> User Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="user">
                        <ul class="side-nav-second-level">
                            @can('user.create')
                                <li>
                                    <a href="{{route('user.create')}}">  Add User</a>
                                </li>
                            @endcan
                            @can('user.index')
                                <li>
                                    <a href="{{route('user.index')}}">Manage User</a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
            @endif
        <!---Category Module--->
            @if(auth()->user()->can('categories.index') || auth()->user()->can('categories.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#category" aria-expanded="false"
                       aria-controls="category" class="side-nav-link">
                        <i class="fa-regular fa-pen-to-square"></i>
                        <span> Category Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="side-nav-second-level">
                            @can('categories.create')
                                <li>
                                    <a href="{{route('categories.create')}}">Add Category</a>
                                </li>
                            @endcan
                            @can('categories.index')
                                <li>
                                    <a href="{{route('categories.index')}}">Manage Category</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Sub Category Module--->
            @if(auth()->user()->can('sub_categories.index') || auth()->user()->can('sub_categories.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#Sub_category" aria-expanded="false"
                       aria-controls="Sub_category" class="side-nav-link">
                        <i class="fa-solid fa-table-list"></i>
                        <span> Sub Category Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="Sub_category">
                        <ul class="side-nav-second-level">
                            @can('sub_categories.create')
                                <li>
                                    <a href="{{route('sub_categories.create')}}">Add Sub Category</a>
                                </li>
                            @endcan
                            @can('sub_categories.index')
                                <li>
                                    <a href="{{route('sub_categories.index')}}">Manage Sub Category</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Sub-Sub Category Module--->
            @if(auth()->user()->can('sub_subcategories.index') || auth()->user()->can('sub_subcategories.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#Sub_sub_category" aria-expanded="false"
                       aria-controls="Sub_sub_category" class="side-nav-link">
                        <i class="fa-solid fa-table-list"></i>
                        <span> Sub Sub-Category  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="Sub_sub_category">
                        <ul class="side-nav-second-level">
                            @can('sub_subcategories.create')
                                <li>
                                    <a href="{{route('sub_subcategories.create')}}">Add Sub Sub-Category</a>
                                </li>
                            @endcan
                            @can('sub_subcategories.index')
                                <li>
                                    <a href="{{route('sub_subcategories.index')}}">Manage Sub Category</a>
                                </li>
                            @endcan


                        </ul>
                    </div>
                </li>
            @endif
        <!--- Brand Module--->
            @if(auth()->user()->can('brands.index') || auth()->user()->can('brands.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#brand" aria-expanded="false"
                       aria-controls="brand" class="side-nav-link">
                        <i class="fa-solid fa-chart-column"></i>
                        <span> Brand Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="brand">
                        <ul class="side-nav-second-level">
                            @can('brands.create')
                                <li>
                                    <a href="{{route('brands.create')}}">Add Brand</a>
                                </li>
                            @endcan
                            @can('brands.index')
                                <li>
                                    <a href="{{route('brands.index')}}">Manage Brand</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Unit Module--->
            @if(auth()->user()->can('units.index') || auth()->user()->can('units.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#unit" aria-expanded="false"
                       aria-controls="unit" class="side-nav-link">
                        <i class="fa-solid fa-circle-notch"></i>
                        <span> Unit Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="unit">
                        <ul class="side-nav-second-level">
                            @can('units.create')
                                <li>
                                    <a href="{{route('units.create')}}">Add Unit</a>
                                </li>
                            @endcan
                            @can('units.index')
                                <li>
                                    <a href="{{route('units.index')}}">Manage Unit</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Color Module--->
            @if(auth()->user()->can('colors.index') || auth()->user()->can('colors.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#color" aria-expanded="false"
                       aria-controls="color" class="side-nav-link">
                        <i class="fa-solid fa-paintbrush"></i>
                        <span> Color Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="color">
                        <ul class="side-nav-second-level">
                            @can('colors.create')
                                <li>
                                    <a href="{{route('colors.create')}}">Add Color</a>
                                </li>
                            @endcan
                            @can('colors.index')
                                <li>
                                    <a href="{{route('colors.index')}}">Manage Color</a>
                                </li>
                            @endcan


                        </ul>
                    </div>
                </li>
            @endif
        <!--- Tag Module--->
            @if(auth()->user()->can('tags.index') || auth()->user()->can('tags.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#tag" aria-expanded="false"
                       aria-controls="tag" class="side-nav-link">
                        <i class="fa-solid fa-tags"></i>
                        <span> Tag Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="tag">
                        <ul class="side-nav-second-level">
                            @can('tags.create')
                                <li>
                                    <a href="{{route('tags.create')}}">Add Tag</a>
                                </li>
                            @endcan
                            @can('tags.index')
                                <li>
                                    <a href="{{route('tags.index')}}">Manage Tag</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif

        <!--- Size Module--->
            @if(auth()->user()->can('sizes.index') || auth()->user()->can('sizes.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#size" aria-expanded="false"
                       aria-controls="size" class="side-nav-link">
                        <i class="fa-brands fa-think-peaks"></i>
                        <span> Size Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="size">
                        <ul class="side-nav-second-level">
                            @can('sizes.create')
                                <li>
                                    <a href="{{route('sizes.create')}}">Add Size</a>
                                </li>
                            @endcan
                            @can('sizes.index')
                                <li>
                                    <a href="{{route('sizes.index')}}">Manage Size</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Product Module--->
            @if(auth()->user()->can('products.index') || auth()->user()->can('products.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#product" aria-expanded="false"
                       aria-controls="product" class="side-nav-link">
                        <i class="fa-regular fa-object-group"></i>
                        <span> Product Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="product">
                        <ul class="side-nav-second-level">
                            @can('products.create')
                                <li>
                                    <a href="{{route('products.create')}}">Add Product</a>
                                </li>
                            @endcan
                            @can('products.index')
                                <li>
                                    <a href="{{route('products.index')}}">Manage Product</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
            @if(auth()->user()->can('delivery_charge.index') || auth()->user()->can('delivery_charge.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#deliveryCharge" aria-expanded="false"
                       aria-controls="deliveryCharge" class="side-nav-link">
                       <i class="fa-solid fa-truck"></i>
                        <span> Delivery charge  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="deliveryCharge">
                        <ul class="side-nav-second-level">
                            @can('delivery_charge.create')
                                <li>
                                    <a href="{{route('delivery_charge.create')}}">Charge create</a>
                                </li>
                            @endcan
                           @can('delivery_charge.index')
                               <li>
                                   <a href="{{route('delivery_charge.index')}}">Charge index</a>
                               </li>
                           @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Stock Management  Module--->
            @if(auth()->user()->can('stock.index') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#stockManagement" aria-expanded="false"
                       aria-controls="stockManagement" class="side-nav-link">
                        <i class="fa-solid fa-arrow-up-short-wide"></i>
                        <span> Stock Management  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="stockManagement">
                        <ul class="side-nav-second-level">
                            @can('stock.index')
                                <li>
                                    <a href="{{route('stock.index')}}">Manage Stock </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!---  Product offer Module--->
            {{--             @if(auth()->user()->can('products_offers.index') || auth()->user()->can('products_offers.create') )--}}
            {{--             <li class="side-nav-item">--}}
            {{--                <a data-bs-toggle="collapse" href="#productOffer" aria-expanded="false"--}}
            {{--                   aria-controls="productOffer" class="side-nav-link">--}}
            {{--                   <i class="fa-brands fa-buffer"></i>--}}
            {{--                    <span> Offer  Product  Module </span>--}}
            {{--                    <span class="menu-arrow"></span>--}}
            {{--                </a>--}}
            {{--                <div class="collapse" id="productOffer">--}}
            {{--                    <ul class="side-nav-second-level">--}}
            {{--                        @can('products_offers.create')--}}
            {{--                        <li>--}}
            {{--                            <a href="{{route('products_offers.create')}}">  Add Offer Product</a>--}}
            {{--                        </li>--}}
            {{--                        @endcan--}}
            {{--                        @can('products_offers.index')--}}
            {{--                        <li>--}}
            {{--                            <a href="{{route('products_offers.index')}}">Manage Offer  Product</a>--}}
            {{--                        </li>--}}
            {{--                        @endcan--}}
            {{--                    </ul>--}}
            {{--                </div>--}}
            {{--            </li>--}}
            {{--            @endif--}}
        <!--- Combo Product Module--->
            @if(auth()->user()->can('combo_product.index') || auth()->user()->can('combo_product.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#combo" aria-expanded="false"
                       aria-controls="combo" class="side-nav-link">
                        <i class="fa-solid fa-recycle"></i>
                        <span> Combo Product  </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="combo">
                        <ul class="side-nav-second-level">
                            @can('combo_product.create')
                                <li>
                                    <a href="{{route('combo_product.create')}}">  Add Combo Product</a>
                                </li>
                            @endcan
                            @can('combo_product.index')
                                <li>
                                    <a href="{{route('combo_product.index')}}">Manage Combo Product</a>
                                </li>
                            @endcan


                        </ul>
                    </div>
                </li>
            @endif
        <!--- Discount Cupon--->
            @if(auth()->user()->can('coupon.index') || auth()->user()->can('coupon.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#cupon" aria-expanded="false"
                       aria-controls="cupon" class="side-nav-link">
                        <i class="fa-solid fa-percent"></i>
                        <span>Cupon Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="cupon">
                        <ul class="side-nav-second-level">
                            @can('coupon.create')
                                <li>
                                    <a href="{{route('coupon.create')}}">Cupon Add </a>
                                </li>
                            @endcan
                            @can('coupon.index')
                                <li>
                                    <a href="{{route('coupon.index')}}">Cupon  Manage</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Order Module--->
            @if(auth()->user()->can('orders.index') || auth()->user()->can('orders.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#order" aria-expanded="false"
                       aria-controls="order" class="side-nav-link">
                        <i class="fa-regular fa-futbol"></i>
                        <span> Order Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="order">
                        <ul class="side-nav-second-level">
                            @can('orders.index')
                                <li>
                                    <a href="{{route('orders.index')}}">Order Manage</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Customer   Module--->
            @if(auth()->user()->can('customers.index'))
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#customer" aria-expanded="false"
                       aria-controls="customer" class="side-nav-link">
                        <i class="fa-solid fa-users"></i>
                        <span> Customer Module</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="customer">
                        <ul class="side-nav-second-level">
                            @can('customers.index')
                                <li>
                                    <a href="{{route('customers.index')}}">Customer manage</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Setting Module--->
            @if(auth()->user()->can('settings.index') || auth()->user()->can('settings.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#setting" aria-expanded="false"
                       aria-controls="setting" class="side-nav-link">
                        <i class="fa-solid fa-gear"></i>
                        <span> Setting Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="setting">
                        <ul class="side-nav-second-level">
                            @can('settings.index')
                                <li>
                                    <a href="{{route('settings.index')}}">Manage Setting</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Popup Module--->
            @if(auth()->user()->can('popups.index') || auth()->user()->can('popups.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#popup" aria-expanded="false"
                       aria-controls="popup" class="side-nav-link">
                        <i class="uil-layer-group"></i>
                        <span> Pop Up Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="popup">
                        <ul class="side-nav-second-level">
                            @can('popups.create')
                                <li>
                                    <a href="{{route('popups.create')}}">  Add Pop Up</a>
                                </li>
                            @endcan
                            @can('carousels.index')
                                <li>
                                    <a href="{{route('popups.index')}}">  Manage Pop Up</a>
                                </li>

                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Policy Module--->
            @if(auth()->user()->can('policy.index') || auth()->user()->can('policy.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#policy" aria-expanded="false"
                       aria-controls="policy" class="side-nav-link">
                        <i class="uil-layer-group"></i>
                        <span> Policy Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="policy">
                        <ul class="side-nav-second-level">
                            @can('policy.create')
                                <li>
                                    <a href="{{route('policy.create')}}">  Add policy</a>
                                </li>
                            @endcan
                            @can('policy.index')
                                <li>
                                    <a href="{{route('policy.index')}}">  Manage policy</a>
                                </li>

                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Banner Module--->
            @if(auth()->user()->can('banner.index') || auth()->user()->can('banner.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#banner" aria-expanded="false"
                       aria-controls="banner" class="side-nav-link">
                        <i class="uil-layer-group"></i>
                        <span> Banner Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="banner">
                        <ul class="side-nav-second-level">
                            @can('banner.create')
                                <li>
                                    <a href="{{route('banner.create')}}">  Add Banner</a>
                                </li>
                            @endcan
                            @can('banner.index')
                                <li>
                                    <a href="{{route('banner.index')}}">  Manage Banner</a>
                                </li>

                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Carousel Module--->
            @if(auth()->user()->can('carousels.index') || auth()->user()->can('carousels.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#carousel" aria-expanded="false"
                       aria-controls="carousel" class="side-nav-link">
                        <i class="fa-brands fa-magento"></i>
                        <span> Carousel Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="carousel">
                        <ul class="side-nav-second-level">
                            @can('carousels.create')
                                <li>
                                    <a href="{{route('carousels.create')}}">  Add Carousel</a>
                                </li>
                            @endcan
                            @can('carousels.index')
                                <li>
                                    <a href="{{route('carousels.index')}}">Manage Carousel</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif

        <!--- Courier Module--->
            {{--             @if(auth()->user()->can('couriers.index') || auth()->user()->can('couriers.create') )--}}
            {{--             <li class="side-nav-item">--}}
            {{--                <a data-bs-toggle="collapse" href="#courier" aria-expanded="false"--}}
            {{--                   aria-controls="courier" class="side-nav-link">--}}
            {{--                   <i class="fa-solid fa-truck"></i>--}}
            {{--                    <span> Courier Module </span>--}}
            {{--                    <span class="menu-arrow"></span>--}}
            {{--                </a>--}}
            {{--                <div class="collapse" id="courier">--}}
            {{--                    <ul class="side-nav-second-level">--}}
            {{--                        @can('couriers.create')--}}
            {{--                        <li>--}}
            {{--                            <a href="{{route('couriers.create')}}">  Add Courier</a>--}}
            {{--                        </li>--}}
            {{--                        @endcan--}}
            {{--                        @can('couriers.index')--}}
            {{--                        <li>--}}
            {{--                            <a href="{{route('couriers.index')}}">Manage Courier</a>--}}
            {{--                        </li>--}}
            {{--                        @endcan--}}
            {{--                    </ul>--}}
            {{--                </div>--}}
            {{--            </li>--}}
            {{--            @endif--}}

        <!--- Courier District /Delevery Location Module--->
            @if(auth()->user()->can('district.index') || auth()->user()->can('district.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#district" aria-expanded="false"
                       aria-controls="district" class="side-nav-link">
                        <i class="fa-solid fa-location-arrow"></i>
                        <span>District Location </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="district">
                        <ul class="side-nav-second-level">
                            @can('district.create')
                                <li>
                                    <a href="{{route('district.create')}}">District Create </a>
                                </li>
                            @endcan
                            @can('district.index')
                                <li>
                                    <a href="{{route('district.index')}}">District  Manage</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Courier Police Station Location Module--->
            {{--             @if(auth()->user()->can('police_station.index') || auth()->user()->can('police_station.create') )--}}
            {{--             <li class="side-nav-item">--}}
            {{--                <a data-bs-toggle="collapse" href="#policeStation" aria-expanded="false"--}}
            {{--                   aria-controls="policeStation" class="side-nav-link">--}}
            {{--                   <i class="fa-solid fa-location-arrow"></i>--}}
            {{--                    <span>Station Location </span>--}}
            {{--                    <span class="menu-arrow"></span>--}}
            {{--                </a>--}}
            {{--                <div class="collapse" id="policeStation">--}}
            {{--                    <ul class="side-nav-second-level">--}}
            {{--                        @can('police_station.create')--}}
            {{--                        <li>--}}
            {{--                            <a href="{{route('police_station.create')}}">Station Create </a>--}}
            {{--                        </li>--}}
            {{--                        @endcan--}}
            {{--                        @can('police_station.index')--}}
            {{--                        <li>--}}
            {{--                            <a href="{{route('police_station.index')}}">Station  Manage</a>--}}
            {{--                        </li>--}}
            {{--                        @endcan--}}
            {{--                    </ul>--}}
            {{--                </div>--}}
            {{--            </li>--}}
            {{--            @endif--}}
{{--        <!--- Blog Category Module--->--}}
{{--            @if(auth()->user()->can('blog_categories.index') || auth()->user()->can('blog_categories.create') )--}}
{{--                <li class="side-nav-item">--}}
{{--                    <a data-bs-toggle="collapse" href="#blog_category" aria-expanded="false"--}}
{{--                       aria-controls="blog_category" class="side-nav-link">--}}
{{--                        <i class="fa-solid fa-table-list"></i>--}}
{{--                        <span> Blog Category Module </span>--}}
{{--                        <span class="menu-arrow"></span>--}}
{{--                    </a>--}}
{{--                    <div class="collapse" id="blog_category">--}}
{{--                        <ul class="side-nav-second-level">--}}
{{--                            @can('blog_categories.create')--}}
{{--                                <li>--}}
{{--                                    <a href="{{route('blog_categories.create')}}">  Add Category</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                            @can('blog_categories.index')--}}
{{--                                <li>--}}
{{--                                    <a href="{{route('blog_categories.index')}}">Manage Category</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--        <!--- Blog Tag Module--->--}}
{{--            @if(auth()->user()->can('blog_tags.index') || auth()->user()->can('blog_tags.create') )--}}
{{--                <li class="side-nav-item">--}}
{{--                    <a data-bs-toggle="collapse" href="#blog_tag" aria-expanded="false"--}}
{{--                       aria-controls="blog_tag" class="side-nav-link">--}}
{{--                        <i class="fa-solid fa-tag"></i>--}}
{{--                        <span> Blog Tag Module </span>--}}
{{--                        <span class="menu-arrow"></span>--}}
{{--                    </a>--}}
{{--                    <div class="collapse" id="blog_tag">--}}
{{--                        <ul class="side-nav-second-level">--}}
{{--                            @can('blog_tags.create')--}}
{{--                                <li>--}}
{{--                                    <a href="{{route('blog_tags.create')}}">  Add Blog Tag</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                            @can('blog_tags.index')--}}
{{--                                <li>--}}
{{--                                    <a href="{{route('blog_tags.index')}}">Manage Blog Tag</a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--        <!--- Blog  Module--->--}}
{{--            @if(auth()->user()->can('blogs.index') || auth()->user()->can('blogs.create') )--}}
{{--                <li class="side-nav-item">--}}
{{--                    <a data-bs-toggle="collapse" href="#blog" aria-expanded="false"--}}
{{--                       aria-controls="blog" class="side-nav-link">--}}
{{--                        <i class="fa-brands fa-hive"></i>--}}
{{--                        <span> Blog  Module</span>--}}
{{--                        <span class="menu-arrow"></span>--}}
{{--                    </a>--}}
{{--                    <div class="collapse" id="blog">--}}
{{--                        <ul class="side-nav-second-level">--}}
{{--                            @can('blogs.create')--}}
{{--                                <li>--}}
{{--                                    <a href="{{route('blogs.create')}}">  Add Blog </a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                            @can('blogs.index')--}}
{{--                                <li>--}}
{{--                                    <a href="{{route('blogs.index')}}">Manage Blog </a>--}}
{{--                                </li>--}}
{{--                            @endcan--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--            @endif--}}
        <!--- Rating  Module--->
            @if(auth()->user()->can('rating.index') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#rating" aria-expanded="false"
                       aria-controls="rating" class="side-nav-link">
                        <i class="fa-solid fa-star"></i>
                        <span> Ratings  Module</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="rating">
                        <ul class="side-nav-second-level">
                            @can('rating.index')
                                <li>
                                    <a href="{{route('rating.index')}}">Manage Ratings </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif

        <!--- Report  Module--->
            @if(auth()->user()->can('sales.report') || auth()->user()->can('daily.sales.report')||auth()->user()->can('monthly.sales.report') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#report" aria-expanded="false"
                       aria-controls="rating" class="side-nav-link">
                        <i class="uil-graph-bar"></i>
                        <span> Report  Module</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="report">
                        <ul class="side-nav-second-level">
                            @can('daily.sales.report')
                                <li>
                                    <a href="{{route('daily.sales.report')}}" target="_blank" >Daily Sales Report </a>
                                </li>
                            @endcan
                            @can('monthly.sales.report')
                                <li>
                                    <a href="{{route('monthly.sales.report')}}" target="_blank" >Monthly Sales Report </a>
                                </li>
                            @endcan
                            @can('sales.report')
                                <li>
                                    <a href="{{route('sales.report')}}" target="_blank" >Sales Report </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif

        <!--- Account  Module--->
            @if(auth()->user()->can('merchant payable') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#accounts" aria-expanded="false"
                       aria-controls="rating" class="side-nav-link">
                        <i class="fa-solid fa-bank"></i>
                        <span> Accounts  Module</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="accounts">
                        <ul class="side-nav-second-level">
                            @can('merchant payable')
                                <li>
                                    <a href="{{route('merchant.payble')}}">Merchant Payble</a>
                                </li>
                            @endcan
                            @can('merchant pay')
                                @if(Auth::user()->role == 'Admin')
                                    <li>
                                        <a href="{{route('merchant.pay.index')}}" >Merchant Pay</a>
                                    </li>
                                @endif
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Contact message  Module--->
            @if(auth()->user()->can('contact_message.index') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#contactMessage" aria-expanded="false"
                       aria-controls="rating" class="side-nav-link">
                        <i class="fas fa-envelope"></i>
                        <span> Contact message </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="contactMessage">
                        <ul class="side-nav-second-level">
                            @can('contact_message.index')
                                <li>
                                    <a href="{{route('contact_message.index')}}">Message index</a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
            @endif
        <!--- About  Module--->
            @if(auth()->user()->can('abouts.index') || auth()->user()->can('abouts.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#about" aria-expanded="false"
                       aria-controls="rating" class="side-nav-link">
                        <i class="fa-solid fa-address-card"></i>
                        <span> About Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="about">
                        <ul class="side-nav-second-level">
                            @can('abouts.create')
                                <li>
                                    <a href="{{route('abouts.create')}}">About create</a>
                                </li>
                            @endcan
                            @can('abouts.index')
                                <li>
                                    <a href="{{route('abouts.index')}}">About index</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Faq  Module--->
            @if(auth()->user()->can('faq.index') || auth()->user()->can('faq.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#faq" aria-expanded="false"
                       aria-controls="rating" class="side-nav-link">
                        <i class="fa-solid fa-circle-question"></i>
                        <span> Faq Module </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="faq">
                        <ul class="side-nav-second-level">
                            @can('faq.create')
                                <li>
                                    <a href="{{route('faq.create')}}">Faq create</a>
                                </li>
                            @endcan
                           @can('faq.index')
                               <li>
                                   <a href="{{route('faq.index')}}">Faq index</a>
                               </li>
                           @endcan
                        </ul>
                    </div>
                </li>
            @endif
        <!--- Terms and condition  Module--->
            @if(auth()->user()->can('terms.index') || auth()->user()->can('terms.create') )
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#terms" aria-expanded="false"
                       aria-controls="rating" class="side-nav-link">
                        <i class="fa-solid fa-file-shield"></i>
                        <span> Terms and condition </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="terms">
                        <ul class="side-nav-second-level">
                            @can('terms.create')
                                <li>
                                    <a href="{{route('terms.create')}}">Terms create</a>
                                </li>
                            @endcan
                            @can('terms.index')
                                <li>
                                    <a href="{{route('terms.index')}}">Terms index</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
        <!--- End Sidemenu -->
        <div class="clearfix"></div>
    </div>
</div>
