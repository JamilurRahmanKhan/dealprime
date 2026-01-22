<!-- Plugins JS File -->
<script src="{{asset('website')}}/assets/js/jquery.min.js"></script>
<script src="{{asset('website')}}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('website')}}/assets/js/plugins.min.js"></script>
<script src="{{asset('website')}}/assets/js/optional/isotope.pkgd.min.js"></script>
<script src="{{asset('website')}}/assets/js/jquery.appear.min.js"></script>
<script src="{{asset('website')}}/assets/js/jquery.plugin.min.js"></script>
{{--<script src="{{asset('website')}}/assets/js/nouislider.min.js"></script>--}}
<script src="{{asset('website')}}/assets/js/price-range/price_range_script.js"></script>

<!-- Main JS File -->
<script src="{{asset('website')}}/assets/js/main.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>

<script src="{{asset('website')}}/assets/js/three-sixty/rotate.js"></script>
<script src="{{asset('website')}}/assets/zoom/jquery.magnify.js"></script>
<script src="{{asset('website')}}/assets/zoom/jquery.magnify-mobile.js"></script>
<script>
    $(document).ready(function() {
        $('img').magnify();
    });
</script>
@php
use Illuminate\Support\Facades\Auth;
@endphp
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function () {
    let footer = document.getElementById("stickyFooter");
    let lastScrollTop = 0;

    window.addEventListener("scroll", function () {
        let scrollTop = window.scrollY || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            // Scrolling Down → Hide Footer
            footer.classList.add("hidden-footer");
        } else {
            // Scrolling Up → Show Footer
            footer.classList.remove("hidden-footer");
        }

        lastScrollTop = scrollTop;
    });
});

    $(function () {
        $(".close").on("click", function () {
            $(".product-default").find("figure").removeClass("load-more-overlay");
            $(".product-default").find("figure .porto-loading-icon").remove();

        })
    });
    function enableSearchButton() {
        var dataSearch = $("#search_product").val();

        if(dataSearch != '' || dataSearch !=null){
            const searchField = document.getElementById('search_product');
            const searchButton = document.getElementById('search_button');

            // Enable the button if the input field is not empty, otherwise disable it
            searchButton.disabled = searchField.value.trim() === '';
        }
        if(dataSearch == '' || dataSearch.charCodeAt(0) == 32 || dataSearch.charCodeAt(0) == NaN ){
             $('#bodyRes').html(`
                <div class="col-lg-12 main-content" id="loading_modal_n" style="">
                    <img src="{{asset('website/assets/images/notfound/search_product.gif')}}" alt="Loading..." style="width: 150px; height: auto;" />
                    <p>Loading, please wait...</p>
                </div>
            `);
            location.reload();
        }

    }
    

    function searchProductList()
    {

        var dataSearch = $("#search_product").val();

        if(dataSearch != '' || dataSearch !=null){
            $('#bodyRes').html(`
                <div class="col-lg-12 main-content" id="loading_modal_n" style="">
                    <img src="{{asset('website/assets/images/notfound/search_product.gif')}}" alt="Loading..." style="width: 150px; height: auto;" />
                    <p>Loading, please wait...</p>
                </div>
            `);
            setTimeout(function() {
                $.ajax({
                    type: "GET",
                    url: "{{url('getSearchProductList')}}",
                    data: {user_input: dataSearch},
                    dataType: "JSON",
                    success: function (response) {
                        $("#loading_modal_n").hide();
                        $('#bodyRes').empty();
                        var data = "";
                        data += '<div class="main">';
                        data += '<div class="container ">';
                        data += '<div class="row">';
                        data += '<div class="col-lg-12 main-content">';
                        data += '<div class="row">';
                        $.each(response.products, function (key, value) {
                            //for pagination
                        // $.each(response.products.data, function (key, value) {
                            console.log(response)

                            // $.each(value.productOffer, function (key, value1) {
                            //     console.log(value.productOffer.discount_amount);

                            var product_id = value.id;
                            data += '<div class="col-6 col-sm-4 col-md-3">';
                            data += '<div class="product-default product-default-search" >';
                            data += '<figure>';
                            data += '<a href="{{route('product_item.details','')}}/' + value.id + '">';
                            data += '<img class="img-fluid" src="' + value.image + '" alt="' + value.name + '" style="width:100%; height:190px;">';
                            data += '</a>';
                            data += '<div class="label-group">';
                            // data += '<div class="product-label label-hot">';
                            // if(value.type == 1){
                            //     data += 'HOT';
                            // }else if(value.type == 2){
                            //     data += 'LATEST';
                            // }else if(value.type == 3){
                            //     data += 'POPULAR';
                            // }
                            // data += '</div>';
                            if (value.discount_amount > 0) {
                                if (value.discount_type == 'percentage') {
                                    data += '<div class="product-label label-sale">';
                                    data += value.discount_amount + '%';
                                    data += '</div>';
                                } else if (value.discount_type == 'flat') {
                                    data += '<div class="product-label label-sale">';
                                    data += value.discount_amount + 'tk off';
                                    data += '</div>';
                                }
                            }

                            data += '</div>';
                            data += '</figure>';
                            data += '<div class="product-details">';
                            data += '<div class="category-wrap">';
                            data += '<div class="category-list">';
                            // data += '<a href="category.html" class="product-category">'+value.category.name+'</a>';
                            data += '</div>';
                            data += '</div>';
                            data += '<h3 class="product-title">';
                            data += '<a href="{{route('product_item.details','')}}/' + value.id + '">' + value.name + '</a>';
                            data += '</h3>';
                            data += '<div class="price-box">';
                            if (value.discount_amount > 0) {
                                data += '<span class="old-price">' + value.regular_price + 'Tk</span>';
                                data += '<span class="product-price">' + (value.selling_price) + 'Tk</span>';

                            } else {
                                data += '<span class="product-price">' + value.regular_price + 'Tk</span>';
                            }
                            data += '</div>';
                            data += '<div class="product-action">';
                            {{--if({{Auth::guard('customer')->check() }}){--}}
                                {{--data += '<a href="{{route('wishlist.add',['customer_id' =>Auth::guard('customer')->id()])}}/'+product_id+'">';--}}
                                data += '<a href="{{ Auth::guard('customer')->check() ? route('wishlist.add',['customer_id' => Auth::guard('customer')->id(),'product_id' =>  '+value.id+']) : route('customer.login')}}">';
                            {{--                            data += '<a href="{{ url('/wishlist/add/', ['customer_id' => Auth::guard('customer')->id()]) }}/'+value.id+'">';--}}


                            // }else{
                            {{--    data += '<a href="{{}}">';--}}

                            // }
                            data += '<button class="btn btn-primary btn-sm">';
                            data += '<i class="fas fa-heart"></i>';
                            data += '</button>';
                            data += '</a>';
                            data += '<a href="{{route('product_item.details','')}}/' + value.id + '" style="margin-right:3px">';
                            data += ' <button class="btn btn-dark btn-sm">details</button>';
                            data += '</a>';

                            {{--if({{Auth::guard('customer')->check()}}){--}}
                                data += '<a href="{{ Auth::guard('customer')->check() ? route('compare.store',['customer_id' => Auth::guard('customer')->id(),'product_id' =>  '+value.id+']) : route('customer.login')}}">';
                            {{--    data += '<a href="{{ URL('/compare/store', ['customer_id' => Auth::guard('customer')->id()]) }}/'+value.id+'">';--}}


                                {{--}else{--}}
                                {{--    data += '<a href="{{route('customer.login')}}">';--}}

                                {{--}--}}

                                data += '<button class="btn btn-primary btn-sm">';
                            data += '<i class="fas fa-recycle"></i>';
                            data += '</button>';
                            data += '</a>';
                            data += '</div>';
                            data += '</div>';
                            
                            data += '</div>';
                            data += '</div>';
                            // data += '</div>';
                        });
                        data += '</div>';
                        data += '</div>';
                        data += '</div>';
                        //for pagination
                        //  data += '<div class="row">';
                        //         data += '<div class="col-12 d-flex justify-content-center align-items-center">';
                        //         data+=response.pagination
                        //         data += '</div>';
                        //     data += '</div>';
                        data += '</div>';
                        data += '</div>';
                        if (response.products.length == 0) {
                            data += '<div class="row bg-white">'
                            data += '<div class=" col-md-12 text-center ">'
                            data += '<h2 class="text-center">Search No Result.</h2>'
                            data += '<h5 class="text-center m-0">  We\'re sorry.We cannot find any matches for your search term.</h5> </br>'
                            data += '</div>'
                            data += '<div class="col-12 d-flex justify-content-center text-center">'
                            {{--                        data += '<img   style="width:100pt ;height:100pt;" src="{{URL::asset('website/assets/images/vector/search-product.jpg')}}" alt="">'--}}
                                data += '<img   style="width:100pt ;height:100pt;" src="{{URL::asset('website/assets/images/zoom-out_14674324.gif')}}" alt="">'
                            data += '</div>'
                            data += '</div>'
                            // $('#bodyRes').append(data);
                        }
                        $('#bodyRes').append(data);
                    }
                });
                $('.product-default-search').addClass('visible');
            }, 1000);
        }
        // if(dataSearch == '' || dataSearch.charCodeAt(0) == 32 || dataSearch.charCodeAt(0) == NaN ){
        //     alert('not available')
        //     $("#loading_modal_n").show();
        //     $('#bodyRes').empty();
        //     // location.reload();
        // }

    }

    function searchProductByPriceList()
    {
        var minPrice = $("#min-price").val();
        var maxPrice = $("#max-price").val();
        // alert(maxPrice)

        if(minPrice != '' || minPrice !=null || maxPrice != '' || maxPrice !=null){

            $.ajax({
                type: "GET",
                url: "{{url('searchProductByPrice')}}",
                data: {min_price: minPrice,max_price: maxPrice},
                dataType: "JSON",
                success: function(response) {
                    // console.log(response)
                    $('#bodyRes').empty();
                    var data = "";
                    data += '<div class="main">';
                    data += '<div class="container ">';
                    data += '<div class="row ">';
                    data += '<div class="col-lg-12 main-content">';
                    data += '<div class="row">';
                    $.each(response.products, function (key, value){
                        console.log(response.products.length)

                        // $.each(value.productOffer, function (key, value1) {
                        //     console.log(value.productOffer.discount_amount);

                        var product_id = value.id;
                        data += '<div class="col-6 col-sm-4 col-md-3">';
                        data += '<div class="product-default">';
                        data += '<figure>';
                        data += '<a href="{{route('product_item.details','')}}/'+value.id+'">';
                        data += '<img class="img-fluid" src="'+value.image+'" alt="'+value.name+'" style="width:100%; height:190px;">';
                        data += '</a>';
                        data += '<div class="label-group">';
                        // data += '<div class="product-label label-hot">';
                        // if(value.type == 1){
                        //     data += 'HOT';
                        // }else if(value.type == 2){
                        //     data += 'LATEST';
                        // }else if(value.type == 3){
                        //     data += 'POPULAR';
                        // }
                        // data += '</div>';
                        if(value.discount_amount > 0  ){
                            if(value.discount_type == 'percentage'){
                                data += '<div class="product-label label-sale">';
                                data += value.discount_amount + '%';
                                data += '</div>';
                            }else if(value.discount_type == 'flat') {
                                data += '<div class="product-label label-sale">';
                                data += value.discount_amount + 'tk off';
                                data += '</div>';

                            }


                        }

                        data += '</div>';
                        data += '</figure>';
                        data += '<div class="product-details">';
                        data += '<div class="category-wrap">';
                        data += '<div class="category-list">';
                        // data += '<a href="category.html" class="product-category">'+value.category.name+'</a>';
                        data += '</div>';
                        data += '</div>';
                        data += '<h3 class="product-title">';
                        data += '<a href="{{route('product_item.details','')}}/'+value.id+'">'+value.name+'</a>';
                        data += '</h3>';
                        data += '<div class="price-box">';
                        if(value.discount_amount > 0 ){
                            data += '<span class="old-price">'+value.regular_price+'Tk</span>';
                            data += '<span class="product-price">'+(value.selling_price)+'Tk</span>';

                        }else{
                            data += '<span class="product-price">'+value.regular_price+'Tk</span>';
                        }
                        data += '</div>';
                        data += '<div class="product-action">';
                        {{--if({{Auth::guard('customer')->check() }}){--}}
                            {{--data += '<a href="{{route('wishlist.add',['customer_id' =>Auth::guard('customer')->id()])}}/'+product_id+'">';--}}
                            data += '<a href="{{ Auth::guard('customer')->check() ? route('wishlist.add',['customer_id' => Auth::guard('customer')->id(),'product_id' =>  '+value.id+']) : route('customer.login')}}">';
                        {{--                            data += '<a href="{{ url('/wishlist/add/', ['customer_id' => Auth::guard('customer')->id()]) }}/'+value.id+'">';--}}


                        // }else{
                        {{--    data += '<a href="{{}}">';--}}

                        // }
                        data += '<button class="btn btn-primary btn-sm">';
                        data += '<i class="fas fa-heart"></i>';
                        data += '</button>';
                        data += '</a>';
                        data += '<a href="{{route('product_item.details','')}}/'+value.id+'" style="margin-right:3px">';
                        data += ' <button class="btn btn-dark btn-sm">details</button>';
                        data += '</a>';

                        {{--if({{Auth::guard('customer')->check()}}){--}}
                            data += '<a href="{{ Auth::guard('customer')->check() ? route('compare.store',['customer_id' => Auth::guard('customer')->id(),'product_id' =>  '+value.id+']) : route('customer.login')}}">';
                        {{--    data += '<a href="{{ URL('/compare/store', ['customer_id' => Auth::guard('customer')->id()]) }}/'+value.id+'">';--}}


                            {{--}else{--}}
                            {{--    data += '<a href="{{route('customer.login')}}">';--}}

                            {{--}--}}

                            data += '<button class="btn btn-primary btn-sm">';
                        data += '<i class="fas fa-recycle"></i>';
                        data += '</button>';
                        data += '</a>';
                        data += '</div>';
                        data += '</div>';
                        data += '</div>';
                        data += '</div>';
                        // data += '</div>';



                    });

                    data += '</div>';
                    data += '</div>';
                    data += '</div>';
                    data += '</div>';
                    data += '</div>';

                    if(response.products.length == 0){
                        data += '<div class="row bg-white">'
                        data += '<div class=" col-md-8 offset-2 text-center ">'
                        data += '<h2 class="text-center">Search No Result.</h2>'
                        data += '<h5 class="text-center m-0">  We\'re sorry.We cannot find any matches for your search term.</h5> </br>'
                        data += '</div>'
                        data += '<div class="col-12 d-flex justify-content-center text-center">'
                        {{--                        data += '<img   style="width:100pt ;height:100pt;" src="{{URL::asset('website/assets/images/vector/search-product.jpg')}}" alt="">'--}}
                            data += '<img   style="width:100pt ;height:100pt;" src="{{URL::asset('website/assets/images/zoom-out_14674324.gif')}}" alt="">'
                        data += '</div>'
                        data += '</div>'

                        // $('#bodyRes').append(data);
                    }
                    $('#bodyRes').append(data);

                }
            });
        }
    }
 $("#trackOrder").on("click", function () {

            var orderNumber = $("#orderNumber").val();
        if (!orderNumber.trim()) {
            // Prevent form submission
            event.preventDefault();
            // Show error message
            errorMessage.style.display = "block";
        }else {
            $.ajax({
                type: "GET",
                url: "{{url('searchOrderTracking')}}",
                data: {orderNumber: orderNumber},
                dataType: "JSON",
                success: function(response) {
                    var order_status = response.orderStatus;
                    var orderTrack = ""
                    orderTrack += '<div id="bar-progress" class="mt-5 mt-lg-0">';
                    if(order_status != ''){
                        if( order_status !=0){
                            if(order_status == 2){
                                orderTrack += '<div class="step step-active">';
                            }else if(order_status == 1){
                                orderTrack += '<div class="step step-active">';
                            } else if(order_status == 3){
                                orderTrack += '<div class="step step-active">';
                            } else{
                                orderTrack += '<div class="step">';
                            }

                            orderTrack += '<span class="number-container">';
                            orderTrack += '<span class="number">&#10004;</span>';
                            orderTrack += '</span>';
                            orderTrack += '<bold><h5>Processing</h5></bold>';
                            orderTrack += '</div>';
                            orderTrack += '<div class="seperator"></div>';
                            if(order_status == 1){
                                orderTrack += '<div class="step step-active">';
                            } else if(order_status == 3){
                                orderTrack += '<div class="step step-active">';
                            } else{
                                orderTrack += '<div class="step">';
                            }
                            orderTrack += '<span class="number-container">';
                            orderTrack += '<span class="number">&#10004;</span>';
                            orderTrack += '</span>';
                            orderTrack += '<bold><h5>Order confirmed</h5></bold>';
                            orderTrack += '</div>';
                            orderTrack += '<div class="seperator"></div>';
                            if(order_status == 3){
                                orderTrack += '<div class="step step-active">';
                            } else{
                                orderTrack += '<div class="step">';
                            }
                            orderTrack += '<span class="number-container">';
                            orderTrack += '<span class="number">&#10004;</span>';
                            orderTrack += '</span>';
                            orderTrack += '<bold><h5>Delivery Complete</h5></bold>';
                            orderTrack += '</div>';
                        }else{
                            orderTrack += '<div class="step ">';
                            orderTrack += '<h4 style="color: red;">Sorry, Your order has been canceled.</h4>';
                            orderTrack += '<p>If you have any questions or concerns, please contact our support team.</p>';
                            orderTrack += '</div>';
                        }
                    }
                    orderTrack += '</div>';
                    $("#orderTrackDiv").empty();
                    $("#orderTrackDiv").append(orderTrack)
                }
            });
            errorMessage.style.display = "none";
        }
        })

    // function searchByOrderTracking()
    // {



    // }
</script>


{{--<script type="text/javascript" language="javascript">--}}
{{--    $(function() {--}}
{{--        $(this).bind("contextmenu", function(e) {--}}
{{--            e.preventDefault();--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

{{--<script>--}}
{{--    document.onkeydown = function(e) {--}}
{{--        if (e.ctrlKey &&--}}
{{--            (e.keyCode === 67 ||--}}
{{--                e.keyCode === 86 ||--}}
{{--                e.keyCode === 85 ||--}}
{{--                e.keyCode === 117)) {--}}
{{--            return false;--}}
{{--        } else {--}}
{{--            return true;--}}
{{--        }--}}
{{--    };--}}
{{--    $(document).keypress("u",function(e) {--}}
{{--        if(e.ctrlKey)--}}
{{--        {--}}
{{--            return false;--}}
{{--        }--}}
{{--        else--}}
{{--        {--}}
{{--            return true;--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}
@yield('script')
