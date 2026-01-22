@extends('admin.layouts.master')
@section('title') Merchant Pay  @endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-center" style="text-align: center;">
                 <h2 class="page-title">Merchant Payble</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-8 mx-auto"  >
                <div class="card" >

                    @if(Auth::user()->role=='Admin' )
                        <div class="card-body">
                        <div class="col-md-6">
{{--                            <h5 class="header-title font-13">--}}
{{--                                @php--}}
{{--                                    $totalOrder = count($merchant_orders);--}}
{{--                                @endphp--}}
{{--                                Total Order = {{$totalOrder}}--}}
{{--                            </h5>--}}
                            <h5 class="header-title font-13">
                                @php
                                    $totalSum = 0;
                                foreach($merchant_orders as $index=>$order){
                                     $order_total =  $order->total_order_amount;
                                    $commission =  $order_total * 10/100;
                                    $payble = $order_total - $commission;
                                   $totalSum += $payble;
                                }
                                @endphp
                                Total Payble Amount = {{$totalSum}} TK
                            </h5>
                        </div>

                        <p class="text-muted font-12">{{Session::get('success')}}</p>
                        <div class="table-responsive  " >
                        <table id="datatable-buttons"  class="table table-bordered table-striped dt-responsive nowrap   p-0">
                            <thead>
                                <tr>
                                    <th class="p-1">SL</th>
                                    <th class="p-1">Marchent Name </th>
                                    <th class="p-1">Order Total  </th>
                                    <th class="p-1">Order Amount Total  </th>
                                    <th class="p-1">Commission (10%) </th>
                                    <th class="p-1">Payble  </th>
                                    <th class="p-1">Paid  </th>
                                    <th class="p-1">Due  </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($merchant_orders->count() > 0)

                                @foreach($merchant_orders as $index=>$order)
                                    @php
                                        $order_total =  $order->total_order_amount;
                                        $commission =  $order_total * 10/100;
                                        $payble = $order_total - $commission;
                                    @endphp
                                    <tr>
                                        <td class="p-1">{{$index +1}}</td>
                                        <td class="p-1" style="text-transform:capitalize">
                                            {{$order->merchant_name}}
                                        </td>
                                        <td class="p-1"> {{$order->total_orders }}</td>
                                        <td class="p-1"> {{number_format($order_total) }}</td>
                                        <td class="p-1">
                                            {{$commission}}
                                        </td>
                                        <td class="p-1"> {{$payble}}</td>
                                        <td class="p-1">
                                            @php
                                                $results = DB::table('merchant_paids')
                                                   ->where('merchant_paids.merchant_id', $order->merchant_id)
                                                   ->select(
                                                       'merchant_paids.merchant_id',
                                                       DB::raw('SUM(merchant_paids.paid_amount) as total_paid_amount')
                                                   )
                                                   ->groupBy('merchant_paids.merchant_id') // Group by merchant_id and merchant name
                                                   ->get();
                                               if(count($results) > 0){
                                                   foreach ($results as $results){
                                                       $total_paid_amount =   $results->total_paid_amount;
                                                   }
                                               }else{
                                                   $total_paid_amount = 0;
                                               }
                                            @endphp
                                           {{$total_paid_amount}}
                                        </td>
                                        <td>{{$payble-$total_paid_amount}}</td>
    {{--                                    <td>--}}
    {{--                                        <a href="{{route('invoice',$order->order_id)}}"--}}
    {{--                                             class="btn btn-warning btn-sm"--}}
    {{--                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Invoice">--}}
    {{--                                             <i class="fa-regular fa-file-lines"></i>--}}
    {{--                                        </a>--}}

    {{--                                    </td>--}}
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
                    @else
                        <div class="card-body">
                            <div class="col-md-6">
                                <h5 class="header-title font-13">
                                    @php
                                        $totalOrder = count($merchant_orders);
                                    @endphp
                                    Total Order = {{$totalOrder}}
                                </h5>
                                <h5 class="header-title font-13">
                                    @php
                                        $totalSum = 0;
                                    foreach($merchant_orders as $index=>$order){
                                         $order_total =  $order->order_total;
                                        $commission =  $order_total * 10/100;
                                        $payble = $order_total - $commission;
                                       $totalSum += $payble;
                                    }
                                    @endphp
                                    Total Payble Amount = {{$totalSum}} TK
                                </h5>
                            </div>

                            <p class="text-muted font-12">{{Session::get('success')}}</p>
                            <div class="table-responsive  " >
                                <table    class="table table-bordered table-striped dt-responsive nowrap   p-0">
                                    <thead>
                                    <tr>
                                        <th class="p-1">SL</th>
                                        <th class="p-1">Order Date  </th>
                                        <th class="p-1">Order No.  </th>
                                        <th class="p-1">Order Total  </th>
                                        <th class="p-1">Commission (10%) </th>
                                        <th class="p-1">Payble  </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if ($merchant_orders->count() > 0)

                                        @foreach($merchant_orders as $index=>$order)
                                            @php
                                                $order_total =  $order->order_total;
                                                $commission =  $order_total * 10/100;
                                                $payble = $order_total - $commission;
                                            @endphp
                                            <tr>
                                                <td class="p-1">{{$index +1}}</td>
                                                <td class="p-1">{{$order->order_date}}</td>
                                                <td class="p-1">{{$order->order_number}}</td>
                                                <td class="p-1"> {{number_format($order_total) }}</td>
                                                <td class="p-1">
                                                    {{$commission}}
                                                </td>
                                                <td class="p-1"> {{$payble}}</td>
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
                        </div>
                    @endif
                </div>  <!-- end card -->
            </div>  <!-- end col -->
        </div>
    </div>
@endsection
