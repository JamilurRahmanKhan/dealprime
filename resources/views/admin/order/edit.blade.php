@extends('admin.layouts.master')
@section('title')Order Edit @endsection
@section('body')
<style>
    .customerInfo{
        height: 200px;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('orders.index')}}">Order Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Order Edit</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Order Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit order form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="courier" class="col-md-3 col-form-label">Select Courier</label>
                            <div class="col-md-9">
                                <select class="form-control" name="courier">
                                    <option selected disabled>---Select Courier---</option>
                                    @foreach ($couriers as $courier)
                                    <option value="{{$courier->id}}"{{$order->order->courier ==$courier->id ?'selected':''}} >{{$courier->name}}</option>
                                    @endforeach
                                </select>
                            <div class="text-danger">@error('courier'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="courier" class="col-md-3 col-form-label">Order Status</label>
                            <div class="col-md-9">
                                <select class="form-control" name="order_status">
                                    <option  disabled>---Select Order Status---</option>
                                    <option value="0" {{$order->order_status ==0?'selected':''}}>Cancelled </option>
                                    <option value="1"  {{$order->order_status ==1?'selected':''}} >Confirmed</option>
                                    <option value="2"  {{$order->order_status ==2?'selected':''}}>Processing</option>
                                    <option value="3"  {{$order->order_status ==3?'selected':''}}>Delivery Complete </option>
                                </select>
                            <div class="text-danger">@error('courier'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Update order info</button>
                            </div>
                        </div>
                    </form>
{{--                        <div class="row mb-3 mt-3">--}}
{{--                            <label for="address" class="col-md-3 col-form-label"></label>--}}
{{--                            <div class="col-md-9">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-4 col-12 col-md-12">--}}
{{--                                        <div class="card " style="background-color: #f8f9fa; box-shadow: 0 8px 16px rgba(223, 195, 195, 0.3);">--}}
{{--                                            <div class="card-body customerInfo">--}}
{{--                                               <div class="h5">Customer Info</div>--}}
{{--                                               <div>Name : {{$merchant_order->order->customer->name}}</div>--}}
{{--                                               <div>Email :{{$merchant_order->order->customer->email}}</div>--}}
{{--                                               <div>Phone : {{$merchant_order->order->customer->phone}}</div>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-4 col-12 col-md-12">--}}
{{--                                        <div class="card " style="background-color: #f8f9fa; box-shadow: 0 8px 16px rgba(223, 195, 195, 0.3);">--}}
{{--                                            <div class="card-body customerInfo">--}}
{{--                                               <div class="h5">Order Total  </div>--}}
{{--                                                <div>{{number_format($merchant_order->order->order_total) }}</div>--}}
{{--                                               <div class="h5">Payment Info </div>--}}
{{--                                                <div>{{$merchant_order->order->payment_method }}</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-4 col-12 col-md-12">--}}
{{--                                        <div class="card " style="background-color: #f8f9fa; box-shadow: 0 8px 16px rgba(223, 195, 195, 0.3);">--}}
{{--                                            <div class="card-body customerInfo">--}}
{{--                                               <div class="h5">Delivery info</div>--}}
{{--                                               <div> {{$merchant_order->order->shipping_address}}</div>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>


@endsection
