<div class="container">


    <div class="footer-middle" >
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                <div class="widget mb-3">
                    <h4 class="widget-title">Address</h4>
                    <p class="m-0"> <i class="fas fa-map-marker-alt"></i> &nbsp;	{{$setting->company_address}}</p>
                    <p class="m-0"> <i class="fas fa-phone"></i>  &nbsp;	{{$setting->support_phone}}</p>
                    <p class="m-0"> <i class="fas fa-envelope"></i> &nbsp;	{{$setting->support_email}}</p>
                   <p class="m-0"> <i class="fas fa-file"></i> Trade license Number: <br>{{$setting->trade_no}}</p>
                    <p class="m-0"> <i class="fas fa-file"></i> TIN Certificate Number: <br>{{$setting->tin_no}}</p>

                </div>
                <!-- End .widget -->
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-6 ">
                <div class="widget mb-3">
                    <h4 class="widget-title">About</h4>

                    <ul class="links">
                        <li><a href="{{route('about')}}">About us</a></li>
                        <li><a href="{{route('faq')}}">FAQs</a></li>
                        {{--                        <li><a href="{{ route('blog', ['id' => 'all_blog']) }}">Blogs</a></li>--}}
                        <li><a href="{{route('store.list')}}">Our Store</a></li>
                        {{--                        <li><a href="#">Career</a></li>--}}
                    </ul>
                </div>
                <!-- End .widget -->
            </div>
            <!-- End .col-lg-3 -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                <div class="widget mb-3">
                    <h4 class="widget-title">Customer Service</h4>
                    <ul class="links">
                        <li><a href="{{route('termsType',['terms_type' => 1,'user_type' => 0])}}">Terms and condition</a></li>
                        <li><a href="{{route('termsType',['terms_type' => 2,'user_type' => 0])}}">Return and Refund Policy</a></li>
                        <li><a href="{{route('termsType',['terms_type' => 3,'user_type' => 0])}}">Privacy Policy</a></li>
                        <li>
                             <p class="m-0"> 
                                <i class="fas fa-truck"></i> &nbsp; Delivery Time:
                            </p>
                            
                            <span class="m-0" style="font-color:#ddd!important"> 
                               Within Dhaka 4-7 days.
                            </span>
                            <span class="m-0" style="font-color:#ddd!important"> 
                                Outside Dhaka 4-10 days.
                            </span>
                           
                        </li> 
                       
{{--                        <li><a href="{{route('order.track')}}">Order Tracking</a></li>--}}
{{--                        <li> --}}
{{--                            <a class="nav-link" id="order-tab" data-toggle="tab"  role="tab" aria-controls="order" aria-selected="true" href="{{route('customer.dashboard')}}">Orders History</a>--}}
{{--                        </li>--}}
                    </ul>
                </div>
                <!-- End .widget -->
            </div>
            <!-- End .col-lg-3 -->



            <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                <div class="widget mb-3">
                    <h4 class="widget-title">Social Media</h4>
                    <div class="social-icons">
                        <a href="{{$setting->facebook}}" class="social-icon social-facebook icon-facebook" target="_blank"></a>
                        <a href="{{$setting->instagram}}" class="social-icon social-instagram icon-instagram" target="_blank"></a>
                        <a href="{{$setting->twitter}}" class="social-icon social-twitter icon-twitter" target="_blank"></a>
                    </div>
                    <!-- End .social-icons -->
                </div>
                <!-- End .col-lg-3 --> 
            </div>
            <!-- End .row -->
            <div class="row">
            <div class="widget mb-3">
                <h4 class="widget-title">Payment Methods</h4>
                @if ($setting->payment_method_image)
                    <img src="{{asset($setting->payment_method_image)}}" alt="payment" width="100%" height="30">
    
                @else
                    <img src="{{asset('website')}}/assets/images/demoes/demo35/payment.png" alt="payment" width="240" height="32">
                @endif
            </div>
        </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p class="footer-copyright text-xl-center text-lg-center text-md-center text-sm-center text-center ls-n-25 mb-0"> © Deal prime Develop by Unitech Solution.
        </p>
    </div>
    <!-- End .footer-bottom -->
</div>
