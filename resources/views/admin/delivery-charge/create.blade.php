@extends('admin.layouts.master')
@section('title')Delivery charge Create @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Delivery charge Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Delivery charge Add</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Delivery charge Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Add Delivery charge form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('delivery_charge.store') }}" method="POST">
                        @csrf
                        
                        <div class="row mb-3">
                            <label for="location_name" class="col-md-3 col-form-label">Delivery Location Name</label>
                            <div class="col-md-9">
                                <select name="location_name" id="location_name" class="form-select">
                                    <option disabled selected>Select Delivery Location</option>
                                    <option value="inside_dhaka">Inside Dhaka</option>
                                    <option value="outside_dhaka">Outside Dhaka</option>
                                    <option value="outside_country">Outside Country</option>
                                </select>
                                <div class="text-danger">@error('location_name'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="delivery_charge" class="col-md-3 col-form-label">Delivery charge </label>
                            <div class="col-md-9">
                                <input type="Delivery charge" class="form-control" value="{{old('delivery_charge')}}" name="delivery_charge" placeholder="Enter delivery charge" id="delivery_charge" />
                            <div class="text-danger">@error('delivery_charge'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" name="status" checked id="status1">
                                    <label class="form-check-label" for="status1">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0" name="status" id="status2">
                                    <label class="form-check-label" for="status2">
                                        Unpublished
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Add Delivery charges</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>


@endsection
