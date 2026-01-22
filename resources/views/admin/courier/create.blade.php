@extends('admin.layouts.master')
@section('title')Couriers Edit @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Couriers Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Couriers Create</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Couriers Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Add Couriers form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{route('couriers.store')}}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Courier Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{old('name')}}" name="name" id="name" placeholder="Courier Name"/>
                            <div class="text-danger">@error('name'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-3 col-form-label">Email</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" value="{{old('email')}}" name="email" id="email" placeholder="Courier Email"/>
                            <div class="text-danger">@error('email'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="mobile" class="col-md-3 col-form-label">Phone Number</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{old('mobile')}}" name="mobile" id="mobile" placeholder="Mobile No"/>
                            <div class="text-danger">@error('mobile'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-md-3 col-form-label"> Address</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{old('address')}}" name="address" id="address" placeholder=" Address"/>
                            <div class="text-danger">@error('address'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="shipping_cost" class="col-md-3 col-form-label">Shipping Cost </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{old('shipping_cost')}}" name="shipping_cost" id="shipping_cost" placeholder="Shipping Cost"/>
                            <div class="text-danger">@error('shipping_cost'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" name="status" checked
                                        id="status1">
                                    <label class="form-check-label" for="status">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0" name="status" id="status2">
                                    <label class="form-check-label" for="status">
                                        Unpublished
                                    </label>
                            </div>
                        </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>


@endsection
