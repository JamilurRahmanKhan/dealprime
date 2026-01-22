@extends('admin.layouts.master')
@section('title')Order Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Order Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Order Manage</li>
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
                    <h4 class="header-title">All Order Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Customer Info </th>
                            <th>Order Number  </th>
                            <th>Payment Status  </th>
                            <th>Order Total  </th>
                            <th>Advance  </th>
                            <th>Due </th>
                            <th>Delivery Address  </th>
                            <th>Order Status  </th>
                            {{-- @if (Auth::user()->role=='Admin')
                            <th>Merchant Name </th>
                            @endif --}}
                            @if(auth()->user()->can('orders.edit') || auth()->user()->can('orders.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($merchant_orders->count()>0)
                            @foreach($merchant_orders as $index=>$order)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>
                                        {{$order->order->customer->name}}
                                        [{{$order->order->customer->phone}}]
                                    </td>
                                    <td> {{$order->order->order_number}}</td>
                                    <td> {{$order->order->payment_method}}</td>
                                    <td>
                                        {{ number_format($order->order->order_total) }}
                                    </td>



                                    <td>
                                        @if($order->order->payment_method == 'online' || $order->order->payment_method == 'fullAmount')
                                            @if($order->order->status == 'Pending')
                                                0 tk
                                            @else
                                                {{number_format($order->order->advance_payment) ?? 0}} tk
                                            @endif
                                        @else
                                            0 tk
                                        @endif

                                    </td>
                                    <td>
                                        @if($order->order->payment_method == 'online' || $order->order->payment_method == 'fullAmount')
                                            @if($order->order->status == 'Pending')
                                              {{number_format($order->order->order_total)}} tk
                                            @else
                                                {{number_format($order->order->due_amount) }} tk
                                            @endif
                                        @else
                                         {{number_format($order->order->order_total)}} tk
                                        @endif
                                    </td>
                                    <td> {{$order->order->shipping_address}}</td>
                                    <td>
                                       @if ($order->order->order_status==0)
                                        <span class="badge rounded-pill bg-danger p-1 px-3"> Cancelled Order</span>
                                        @elseif ($order->order->order_status==1)
                                        <span class="badge rounded-pill bg-warning p-1 px-3">Confirmed Order</span>
                                        @elseif ($order->order->order_status==2)
                                        <span class="badge rounded-pill bg-primary p-1 px-3">Processing</span>
                                        @elseif ($order->order->order_status==3)
                                        <span class="badge rounded-pill bg-info p-1 px-3">delivery complete</span>
                                       @endif
                                    </td>
                                    {{-- @if (Auth::user()->role=='Admin')
                                    <td> {{$order->user}}</td>
                                    @endif --}}

                                    <td>
                                        <a href="{{route('order.detail',$order->order->id)}}"
                                            class="btn btn-danger btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Order Details" target="_blank">
                                           <i class="fa-solid fa-eye"></i>
                                       </a>

                                        <a href="{{route('orders.show',$order->order->id)}}"
                                            class="btn btn-primary btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Order Details" target="_blank">
                                           <i class="fa-solid fa-eye"></i>
                                       </a>
                                        <a href="{{route('orders.edit',$order->order->id)}}"
                                             class="btn btn-success btn-sm"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Order Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>
                                        <!--<a href="{{route('invoice',$order->order->id)}}"-->
                                        <!--     class="btn btn-warning btn-sm"-->
                                        <!--     data-bs-toggle="tooltip" data-bs-placement="top" title="Invoice">-->
                                        <!--     <i class="fa-regular fa-file-lines"></i>-->
                                        <!--</a>-->

                                        {{-- <form action="{{route('invoice',$order->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this teacher?');">
                                                <i class="fa-regular fa-file-lines"></i>
                                            </button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="text-center">Order not found </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>
@endsection
