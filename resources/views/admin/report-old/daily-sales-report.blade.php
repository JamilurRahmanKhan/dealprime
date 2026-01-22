@extends('admin.layouts.master')
@section('title')Order Manage  @endsection
@section('body')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-left">
                        <h2 class="page-title">Daily Sales Report</h2>
                    </div>

                </div>
            </div>
            <div class="col-lg-12 col-md-12 mx-auto"  >
                <div class="card" >

                    <div class="card-body">
                        <div class="col-md-6 col-lg-12">
                            <h5 class="header-title font-13">
                                @php
                                    $totalSum = 0;
                                foreach($sales_reports as $index=>$order){
                                    $totalSum += $order->selling_price;
                                }
                                @endphp
                                Total Order Amount = {{$totalSum}} TK
                            </h5>
                        </div>
                        <div class="table-responsive">

                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap ">
                                <thead>
                                <tr>
                                    <th class="p-1">Order Number  </th>
                                    <th class="p-1">Date  </th>
                                    <th class="p-1">Seller Name </th>
                                    <th class="p-1">Product </th>
                                    <th class="p-1">Product Type</th>
                                    <th class="p-1">Quantity</th>
                                    <th class="p-1">Unit Price</th>
                                    <th class="p-1">Total Price</th>
                                    {{--                                    <th>Action</th>--}}
                                </tr>

                                </thead>
                                <tbody>
                                @if ($sales_reports->count() > 0)
                                    @php
                                        $netTotal = 0;
                                    @endphp
                                    @foreach($sales_reports as $index=>$order)
                                        <tr>
                                            <td > {{$order->order_number}}</td>
                                            <td > {{$order->order_date}}</td>
                                            <td style="text-transform:capitalize">
                                                {{$order->user_name}}
                                            </td>
                                            <td  style="text-transform:capitalize">
                                                {{$order->product_name}}
                                            </td>
                                            <td>
                                                @if($order->type == 1)
                                                    Hot
                                                @elseif($order->type == 2)
                                                    Latest
                                                @elseif ($order->type == 3)
                                                    Popular
                                                @elseif ($order->type == 4)
                                                    Recommendation for you
                                                @elseif ($order->type == 5)
                                                    DealPrime picks
                                                @elseif ($order->type == 6)
                                                    Feature
                                                @elseif ($order->type == 7)
                                                    Seasonal Favourite
                                                @endif
                                            </td>
                                            <td>{{$order->qty}}</td>
                                            <td> {{number_format($order->selling_price) }}</td>
                                            <td>{{$order->qty * $order->selling_price}}</td>


                                            {{--                                            <td>--}}
                                            {{--                                                <a href="{{route('invoice',$order->order_id)}}"--}}
                                            {{--                                                   class="btn btn-warning btn-sm"--}}
                                            {{--                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Invoice">--}}
                                            {{--                                                    <i class="fa-regular fa-file-lines"></i>--}}
                                            {{--                                                </a>--}}

                                            {{--                                            </td>--}}
                                        </tr>
                                        @php
                                            $netTotal += $order->selling_price
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td style="text-align: right;" colspan="7">Net total</td>
                                        <td>{{$netTotal}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">Order not found </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  <!-- end card -->
            </div>  <!-- end col -->
        </div>
    </div>
@endsection
