@extends('admin.layouts.master')
@section('title')Products Offer Show  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('products_offers.index')}}">Product Offer Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Product Offer Details</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Product Offers Module</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header border-bottom">
                <h3 class="card-title">Product Offers Detail Information
                    <span class="float-end">
                      <a href="{{route('products_offers.index')}}"><button class="btn btn-sm btn-primary" title="back to manage"><i class="fa-solid fa-arrow-rotate-left"></i></button></a>
                       <a href="{{route('products_offers.edit',$product_offer->id)}}"><button class="btn btn-sm btn-info" title="Edit"><i class="fa-solid fa-pen-to-square"></i></button></a>
                    </span>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th>Product ID</th>
                        <td>{{$product_offer->id}}</td>
                    </tr>
                    <tr>
                        <th>Offer Product Name</th>
                        <td>{{$product_offer->product->name}}</td>
                    </tr>
                    <tr>
                        <th>Discount Amount</th>
                        <td>
                            {{$product_offer->discount_amount}}
                        </td>
                    </tr>
                        <th>Publication Status</th>
                        <td>
                            {{ $product_offer->status == 1 ? "Published" : "Not Published" }}
                        </td>
                    </tr>


                </table>
            </div>
        </div>
    </div>
</div>
@endsection
