@extends('admin.layouts.master')
@section('title') Dashboard @endsection
@section('body')
<style>

.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}
</style>
 <!-- Login Success Toaster -->
 @if (Session::get('loginSuccess'))
 <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 1055;">
     <div class="toast text-center align-items-center py-3 px-5 text-white bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true">
         <div class="d-flex justify-content-center">
             <div class="toast-body justify-content-center ">
              {{ Session::get('loginSuccess') . ' ' . Auth::user()->role }}
             </div>
             <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
         </div>
     </div>
 </div>
 @endif
<!-- Login Success Toaster Toaster end -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Dashboard </li>
                        </ol>
                      </nav>
                     </div>
                <h3 class="page-title">Dashboard <small>{{Auth::user()->role}} Panal</small> </h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="container p-0">
                <div class="row">
                    <!--merchent user-->
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Merchent Users</h6>
                                <h2 class="text-right">
                                    <i class="fa-solid fa-user-tie"></i>
                                    <span>486</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                     <!--Total Customer-->
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Total Customer</h6>
                                <h2 class="text-right">
                                    <i class="fa-solid fa-user-group"></i>
                                    <span>980</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                     <!--Total Order Received-->
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Orders Received</h6>
                                <h2 class="text-right">
                                    <i class="fa-solid fa-rocket"></i>
                                    <span>486</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                     <!--Total Pending Orders-->
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Pending Orders</h6>
                                <h2 class="text-right">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <span>486</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                     <!--Total Complete Orders-->
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Complete Orders</h6>
                                <h2 class="text-right">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>486</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                     <!--Total Products-->
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Total Products</h6>
                                <h2 class="text-right">
                                    <i class="fa-regular fa-rectangle-list"></i>
                                    <span>486</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                     <!--Total Earnings-->
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Total Earning</h6>
                                <h2 class="text-right">
                                    <i class="fa-regular fa-credit-card"></i>
                                    <span>486</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xl-3">
                        <div class="card bg-c-blue order-card">
                            <div class="card-block">
                                <h6 class="m-b-20">Total Courier</h6>
                                <h2 class="text-right">
                                    <i class="fa-solid fa-truck-moving"></i>
                                    <span>486</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
@endsection
