@extends('admin.layouts.master')
@section('title')
    Merchant Paid
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('merchant.payble') }}">Merchant Paid Module</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Merchant Paid</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Merchant Paid Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 offset-md-1 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Add Merchant Paid form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{route('merchant.pay.store')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="" name="total_order_amount" id="total_order_amount">
                        <!--Merchant select -->
                        <div class="row mb-3">
                           <label for="merchant_id" class="col-md-3 col-form-label">Merchant Select</label>
                           <div class="col-md-9">
                               <select class="form-select " name="merchant_id" id="merchant_id" onchange="getMerchantId(this.value)">
                                   <option disabled selected>Please Select Merchant </option>
                                   @if ($merchants->count()>0)
                                   @foreach ($merchants as $merchant )
                                   <option value="{{$merchant->id}}">{{$merchant->name}} </option>
                                   @endforeach
                                   @else
                                   <option disabled class="text-danger ">Opps! Sorry, Merchant user not found! </option>
                                   @endif
                               </select>
                               <div class="text-danger">@error('merchant_id'){{ $message }} @enderror</div>
                           </div>
                       </div>
                        <!-- product price  -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label"> Paid amount </label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" id="paid_amount" onclick="checkAmount()"  name="paid_amount"
                                            placeholder="Paid Amount ">
                                <div class="text-danger">
                                    @error('paid_amount')
                                        {{ $message }}
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label"> Paid amount </label>
                            <div class="col-md-9">
                                <input type="date" class="form-control" id="paid_date"  name="paid_date"
                                            placeholder="Regular Price " value="{{ old('paid_date', date('Y-m-d')) }}">
                                <div class="text-danger">
                                    @error('paid_date')
                                        {{ $message }}
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <!-- product discount price  -->
                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info ">Pay</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    @include('admin.layouts.text-editor')



<script>

    function getMerchantId($merchant_id)
    {

        $('#merchant_id').next('.text-danger').text('');
        $.ajax({
            type: "GET",
            url: "{{url('get_merchant_paid_amount')}}",
            data: {merchant_id: $merchant_id},
            dataType: "JSON",
            success: function(response) {
               var totalOrderAmount =  $("#total_order_amount").val(response.total_order_amount);

            }
        });
    }
    function checkAmount() {
        var merchant_id = $('#merchant_id').val();
        if (!merchant_id) {
            isValid = false;
            $('#merchant_id').next('.text-danger').text('Please select a merchant.');
        }else{
            $('#merchant_id').next('.text-danger').text('');
        }

    }

    $(document).ready(function () {
        // Trigger validation on form submission
        $('form').on('submit', function (e) {
            let isValid = true;
        //
        //     // Validate Subcategory
            const merchant_id = $('#merchant_id').val();
            if (!merchant_id) {
                isValid = false;
                $('#merchant_id').next('.text-danger').text('Please select a merchant.');
            }
            var totalOrderAmount =  $("#total_order_amount").val();

            var paid_amount =  $("#paid_amount").val();

            if ($('#paid_amount').val() && isNaN($('#paid_amount').val())) {
                isValid = false;
                $('#paid_amount').next('.text-danger').text('Paid amount must be a valid number.');

            }
            if(  paid_amount > totalOrderAmount){
                isValid = false;
                $('#paid_amount').next('.text-danger').text('Paid amount is grater then order amount.');
            }


        //     // Prevent form submission if invalid
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
</script>

@endsection
