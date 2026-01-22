<style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        /*box-shadow:0 0 10px rgba(0, 0, 0, .15);*/
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }

    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }

    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }

    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }

    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }

    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }

    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }

    .invoice-box table tr.heading td{
        /*background:#eee;*/
        border-bottom:1px solid #eee;
        font-weight:bold;
    }

    .invoice-box table tr.details td{
        padding-bottom:20px;
    }

    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }

    .invoice-box table tr.item.last td{
        border-bottom:none;
    }

    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }

        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
</style>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-box" style="background-color: white;">
                <table cellpadding="0" cellspacing="0" >
                    <tr class="top">
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td class="title">
                                        <img src="{{ asset('website') }}/assets/images/logo/deal.jpg" style="height: 70px; width:200px" alt="Logo">
                                    </td>
                                    <td>
                                        Invoice #: {{$merchant_order->order->order_number}}<br>
                                        Created:  {{ date("F j, Y") }}<br>
                                        Order Date: {{date('ymj',strtotime($merchant_order->order->order_date))}}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class="information">
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td>
                                        <h3>Order Delivery Info</h3>
                                        <span> Name :  {{$merchant_order->order->customer->name}}</span> <br>
                                        <span> Address :  {{$merchant_order->order->shipping_address}}</span> <br>
                                        <span> Mobile Number : {{$merchant_order->order->customer->phone}} </span><br>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table border="1">
                    <tr>
                        <th>sl</th>
                        <th>Name</th>
                        <th>code</th>
                        <th>image</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>total</th>
                    </tr>

                    @php
                    $sum = 0; // Initialize the sum
                @endphp
                @foreach ($order_details as $index=>$item)
                <tr>
                    <td>
                        {{$index +1}}
                    </td>

                    <td>
                        {{ $item->product->name }}
                        <div>{{ $item->color }}</div>
                        <div>{{ $item->size }}</div>
                    </td>
                    <td>{{ $item->product->code }}</td>
                    <td>
                        <img src="{{ asset($item->product->image) }}" style="height: 50px; width: 50px" alt="">
                    </td>
                    <td >
                        @if ($item->product_discount)
                            @php
                                $unit_price = $item->product->selling_price - ($item->product->selling_price * ($item->product_discount / 100));
                            @endphp
                            <span>{{ number_format($unit_price) }} tk</span>
                            <span class="badge bg-success"> -{{ $item->product_discount }} % Off</span>
                        @else
                            @php
                                $unit_price = $item->product->selling_price;
                            @endphp
                            <span>{{ number_format($unit_price) }} tk</span>
                        @endif
                    </td>
                    <td>{{ $item->qty }}</td>
                    <td>
                        @php
                            $total = $item->qty * $unit_price;
                        @endphp
                        {{ number_format($total) }} tk
                    </td>
                </tr>
                @php
                    $sum += $total;
                @endphp
                @endforeach
                    <tr class="total">
                </table>
                <table>
                    <tr>
                        <td style="text-align: right;">
                            Total: {{ number_format($sum) }} tk<br>
                            @if ($item->coupon_discount_amount)
                            Coupon Discount: - {{$item->coupon_discount_amount}} tk  <br>
                            @endif
                            Tax total: {{ number_format($item->tax_total) }} tk <br>
                            Shipping Cost: {{$item->order->shipping_cost}} tk <br>
                            Pay total	: {{number_format($item->order->order_total) }} tk <br>
                           {{-- @if($rate=$orderInfo->rate=="Free")
                               @if($orderInfo->discount == null)
                                   Shipping<span style="font-size: 10px"></span> : Free<br>
                                   Total: TK. {{ $total }}
                               @else
                                   Shipping<span style="font-size: 10px"></span> : Free<br>
                                   Total: TK. {{ $total-$orderInfo->discount }}
                               @endif
                           @else
                               @if($orderInfo->discount ==null)
                                   Shipping<span style="font-size: 10px"></span> : TK {{ $rate=$orderInfo->rate }}<br>
                                   Total: TK. {{ $total+$rate }}
                               @else
                                   Shipping<span style="font-size: 10px"></span> : TK {{ $rate=$orderInfo->rate }}<br>
                                   Total: TK. {{ ($total+$rate)-$orderInfo->discount }}
                               @endif
                           @endif --}}

                        </td>
                    </tr>
                </table>
                <hr/>
                <br/><br/><br/><br/><br/>
                <table cellpadding="0" cellspacing="0" >
                    <tr class="information">
                        <td colspan="2">
                            <table>
                                <tr>
                                    <td>
                                        <hr/>
                                        Received By Signature
                                    </td>

                                    <td>
                                        <hr/>
                                        Delivery By Signature
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section><!-- /.content -->
