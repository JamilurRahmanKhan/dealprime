@extends('admin.layouts.master')
@section('title')Discount Coupon Add @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Discount Coupon Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Discount Coupon Edit</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Discount Coupon Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Discount Coupon form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{route('coupon.update',$coupon->id)}}" method="POST">
                        @method('put')
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Coupon Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  value="{{$coupon->name}}" name="name" id="name" placeholder="Coupon  Name"/>
                                <div class="text-danger">@error('name'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="code" class="col-md-3 col-form-label">Coupon Code</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$coupon->code}}" name="code" id="code" placeholder="Coupon Code" />
                                <div class="text-danger">@error('code'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="code" class="col-md-3 col-form-label">Coupon Type</label>
                            <div class="col-md-9">
                                <select class="form-control" name="coupon_type">
                                    <option disabled >Select Coupon Type</option>
                                    <option value="percentage" {{$coupon->coupon_type=='percentage'?'selected':''}}>Percentage</option>
                                    <option value="fixed" {{$coupon->coupon_type=='fixed'?'selected':''}}>Fixed Money</option>
                                </select>
                                <div class="text-danger">@error('coupon_type'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="coupon_amount" class="col-md-3 col-form-label">Percentage /fixed coupon amount</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" value="{{$coupon->coupon_amount}}" name="coupon_amount" id="coupon_amount" placeholder="Coupon Amount" />
                                <div class="text-danger">@error('coupon_amount'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cart_amount" class="col-md-3 col-form-label">Cart Amount</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" value="{{$coupon->cart_amount}}" name="cart_amount" id="cart_amount" placeholder="Cart Amount" />
                                <div class="text-danger">@error('cart_amount'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="start_day" class="col-md-3 col-form-label">Start Day</label>
                            <div class="col-md-9">
                                @php $coupon->start_day = \Carbon\Carbon::parse($coupon->start_day)->format('Y-m-d'); @endphp
                                <input type="date" class="form-control" value="{{$coupon->start_day}}" name="start_day" id="start_day"/>
                                <div class="text-danger">@error('start_day'){{$message}} @enderror</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="end_day" class="col-md-3 col-form-label">End Day  </label>
                            <div class="col-md-9">
                                @php $coupon->end_day = \Carbon\Carbon::parse($coupon->end_day)->format('Y-m-d'); @endphp
                                <input type="date" class="form-control" value="{{$coupon->end_day}}" name="end_day" id="end_day"/>
                                <div class="text-danger">@error('end_day'){{$message}} @enderror</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$coupon->status=='1'?'checked':''}} type="radio" value="1" name="status"
                                        id="status1">
                                    <label class="form-check-label" for="status">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$coupon->status=='0'?'checked':''}}  type="radio" value="0" name="status" id="status2">
                                    <label class="form-check-label" for="status">
                                        Unpublished
                                    </label>
                            </div>
                        </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Update Coupon</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>

@endsection
