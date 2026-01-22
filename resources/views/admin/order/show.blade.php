<!DOCTYPE html>
<html lang="en">

<!--head section  -->
<head>
    <meta charset="utf-8" />
    <title>Deal prime | Order Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <?php header('Content-Type: text/xml'); ?>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('/')}}admin/assets/images/gadget.jpg"/>

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="{{asset('/')}}admin/assets/vendor/daterangepicker/daterangepicker.css">

    <!-- Vector Map css -->
    <link rel="stylesheet" href="{{asset('/')}}admin/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">

    <!-- Theme Config Js -->
    <script src="{{asset('/')}}admin/assets/js/hyper-config.js"></script>
    <!-- Datatables css -->
    <link href="{{asset('/')}}admin/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}admin/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}admin/assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}admin/assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}admin/assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('/')}}admin/assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme Config Js -->
    <script src="{{asset('/')}}admin/assets/js/hyper-config.js"></script>
    <!-- App css -->
    <link href="{{asset('/')}}admin/assets/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons css -->
    <link href="{{asset('/')}}admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Custom css & js code  personal add -->
    <link href="{{asset('/')}}admin/assets/custom-assets/custom.css" rel="stylesheet" type="text/css" />

    <!--select2 css-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- textarea text editor  -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <style>
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .order-section {
            margin-bottom: 20px;
        }
        .order-section .card {
            padding: 20px;
        }
        .items-ordered table th, .items-ordered table td {
            vertical-align: middle;
        }
        .badge-status {
            font-size: 0.9rem;
        }
        .table th, .table td {
            text-align: center;
        }
        .detailCart{
            height: auto;
            background-color: #f8f9fa; box-shadow: 0 8px 16px rgba(223, 195, 195, 0.3);
        }
    </style>
</head>

<body>
<!-- Begin page -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12">
                <div class="card">
                <div class="card-body">
                    <div class="container">
                        <!--<div class="order-header">-->
                        <!--    <h2>Order# {{$orders->order_number}}</h2>-->
                            <!--<span class="badge bg-info text-dark badge-status">Ready for ship</span>-->
                        <!--</div>-->

                        <!--<div class="order-section d-flex justify-content-between align-items-center mb-3">-->
                        <!--    <div class="d-inline">-->
                        <!--        {{-- <strong>Paid on:</strong> 2024-02-13, 12:56 --}}-->
                        <!--        <br><strong>Order placed date :</strong> {{$orders->order_date}}-->
                        <!--        <br>-->
                                <!--<strong>Updated:</strong> {{ \Carbon\Carbon::parse($orders->updated_at)->diffForHumans() }}-->
                        <!--    </div>-->
                        <!--    <div>-->
                        <!--        <img src="{{asset('website')}}/assets/images/logo/DealPrimeLogo.png" alt="Deal Prime" style="width: 100px"><br><br>-->
                        <!--        <button class="btn btn-success" onclick="window.print()"><i class="fa-solid fa-file-invoice"></i> Print Invoice</button>-->
                        <!--    </div>-->
                        <!--</div>-->

                            <div class="order-section d-flex justify-content-between align-items-center mb-3">
                                <div class="col-7">
                                    {{-- <strong>Paid on:</strong> 2024-02-13, 12:56 --}}
                                    <h4 >Order# {{$orders->order_number}}</h4>
                                    <strong>Order date :</strong> {{$orders->order_date}}
                                    {{-- <br><strong>Updated:</strong> {{ \Carbon\Carbon::parse($orders->updated_at)->diffForHumans() }} --}}
                                </div>
                                <div class="col-5 text-end">
                                    <img src="{{asset('website')}}/assets/images/logo/DealPrimeLogo.png" alt="Deal Prime" style="width: 100px"><br><br>
                                     <button class="btn btn-success" onclick="window.print()"><i class="fa-solid fa-file-invoice"></i> Print Invoice</button>
                                </div>
                            </div>
                        <div class="row">
                            <!-- Customer & Order Info -->
                            <div class="col-md-4">
                                <div class="">
                                    <h5 class="">Customer & Order </h5>
                                    <p class="mb-1"><strong>Name:</strong> {{$orders->customer->name}}</p>
{{--                                    <p class="mb-1"><strong>Email:</strong> {{$orders->customer->email}}</p>--}}
                                    <p class="mb-1"><strong>Phone:</strong>{{$orders->customer->phone}}</p>
                                    <p><strong>Post Code:</strong>{{$orders->post_code}}</p>
                                </div>
                            </div>
                            <!-- Billing Address -->
                            <div class="col-md-4">
                                <div class="">
                                 <h5 class="">Shipping Details </h5>
                                 <p class="m-0"><strong>Shipping Address:</strong>{{$orders->shipping_address}}</p>
                                 <p class="mt-1 mb-0"><strong>Payment Method:</strong> {{$orders->payment_method}}</p>
                                 <!--<p class="mt-1 mb-0"><strong>Delivery Cost:</strong> {{$orders->shipping_cost}}</p>-->
                                 {{-- <p class="mt-1"><strong>Courier:</strong>{{$orders->order->courier->name}}</p> --}}
                                 {{-- <p class="mt-1"><strong>Courier email:</strong>{{$orders->order->courier->email}}</p> --}}
                                </div>
                            </div>
                        </div>

                        <!--combo Items Ordered -->
                        <div class="order-section items-ordered">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Items ordered</h5>
                                {{-- <button class="btn btn-sm btn-outline-secondary">Edit</button> --}}
                            </div>
                            <table class="table table-bordered mt-2">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Items Name</th>
                                        <th>Code</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $p_sum = 0; // Initialize the sum
                                @endphp
                                @foreach ($order_details as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($item->image) }}" style="height: 50px; width: 50px" alt="">
                                        </td>
                                        <td>
                                            {{ $item->name }}
                                            <div>{{ $item->color }}</div>
                                            <div>{{ $item->size }}</div>
                                        </td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>
                                            <span>{{ number_format($item->selling_price) }} tk</span>
                                        </td>
                                        <td>
                                            @php
                                                $total = $item->qty * $item->selling_price; // Calculate total price for the current item
                                            @endphp
                                            {{ number_format($total) }} tk
                                        </td>
                                    </tr>
                                    @php
                                        $p_sum += $total; // Add the total of each item to the sum
                                    @endphp
                                @endforeach

                                </tbody>
                                <tbody>
                                    @php
                                    $c_sum = 0; // Initialize the sum
                                @endphp
                                @foreach ($comboProductresults as $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset($item->image) }}" style="height: 50px; width: 50px" alt="">
                                    </td>
                                    <td>
                                        {{ $item->name }}
                                        <div>{{ $item->color }}</div>
                                        <div>{{ $item->size }}</div>
                                    </td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>
                                        <span>{{ number_format($item->selling_price) }} tk</span>
                                    </td>
                                    <td>
                                        @php
                                            $total = $item->qty * $item->selling_price; // Calculate total price for the current item
                                        @endphp
                                        {{ number_format($total) }} tk
                                    </td>
                                </tr>
                                @php
                                    $c_sum += $total; // Add the total of each item to the sum
                                @endphp
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-end">Subtotal</th>
                                        <td>{{ number_format($p_sum+$c_sum) }} tk</td>
                                    </tr>
                                    @if (isset($item->coupon_discount))
                                    <tr>
                                        <th colspan="5" class="text-end">Coupon Discount</th>
                                        <td> - {{$item->coupon_discount_amount ?? 0}} tk
                                        <!--<span class="badge bg-success">{{ $item->coupon_discount }} Off</span>-->
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th colspan="5" class="text-end">Shipping Cost</th>
                                        <td>{{$item->shipping_cost ?? 0}} tk</td>
                                    </tr>
                                    <tr>
                                    <th colspan="5" class="text-end">Advance Payment</th>
                                    <td>
                                         @if($orders->status == 'Pending')
                                            0  tk
                                        @else
                                            {{$item->advance_payment ?? 0}} tk
                                        @endif
                                        </td>
                                </tr>
                                <tr>
                                    <th colspan="5" class="text-end">Pay total</th>
                                    <td>

                                    @if($orders->status == 'Pending')
                                        {{number_format($item->order_total)}} tk
                                    @else
                                        {{number_format($item->order_total - $item->advance_payment) }} tk
                                    @endif
                                    </td>
                                </tr>
                                </tfoot>
                            </table>


                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                        @endif
                        <!-- Display order details -->
                            <h3>Order #{{ $orders->id }}</h3>
                            <p><strong>Status:</strong> {{ $orders->order_status }}</p>
                            <p><strong>Total:</strong> {{ $orders->order_total }}</p>
                            <p><strong>Address:</strong> {{ $orders->delivery_address }}</p>

                            <form action="{{ route('admin.pathao.placeOrder', $orders->id) }}"
                                  method="POST">
                            @csrf
                            <!-- Select City -->
                                <div class="form-group">
                                    <label for="city_id">Select City</label>
                                    <select name="city_id" id="city_id" class="form-control">
                                        <option value="">Select City</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city['city_id'] }}">{{ $city['city_name']
                                            }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Select Zone -->
                                <div class="form-group">
                                    <label for="zone_id">Select Zone</label>
                                    <select name="zone_id" id="zone_id" class="form-control">
                                        <option value="">Select Zone</option>
                                        <!-- Zones will be populated dynamically -->
                                    </select>
                                </div>
                                <!-- Select Area -->
                                <div class="form-group">
                                    <label for="area_id">Select Area</label>
                                    <select name="area_id" id="area_id" class="form-control">
                                        <option value="">Select Area</option>
                                        <!-- Areas will be populated dynamically -->
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Place Order with
                                    Pathao</button>
                            </form>
                            <script>
                                // When a city is selected, fetch corresponding zones
                                document.getElementById('city_id').addEventListener('change', function ()
                                {
                                    const cityId = this.value;
                                    if (cityId) {
                                        fetch(`/pathao/api/zones/${cityId}`) // Note the backticks here
                                            .then(response => response.json())
                                            .then(data => {
                                                const zoneSelect = document.getElementById('zone_id');
                                                zoneSelect.innerHTML = '<option value="">Select
                                                Zone</option>';
                                                data.forEach(zone => {
                                                    const option = document.createElement('option');
                                                    option.value = zone.zone_id;
                                                    option.textContent = zone.zone_name;
                                                    zoneSelect.appendChild(option);
                                                });
// Clear areas when city is changed
                                                document.getElementById('area_id').innerHTML = '<option
                                                value="">Select Area</option>';
                                            });
                                    }
                                });
                                // When a zone is selected, fetch corresponding areas
                                document.getElementById('zone_id').addEventListener('change', function ()
                                {
                                    const zoneId = this.value;
                                    if (zoneId) {
                                        fetch(`/pathao/api/areas/${zoneId}`) // Note the backticks here
                                            .then(response => response.json())
                                            .then(data => {
                                                const areaSelect = document.getElementById('area_id');
                                                areaSelect.innerHTML = '<option value="">Select
                                                Area</option>';
                                                data.forEach(area => {
                                                    const option = document.createElement('option');
                                                    option.value = area.area_id;
                                                    option.textContent = area.area_name;
                                                    areaSelect.appendChild(option);
                                                });
                                            });
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

</body>

</html>
