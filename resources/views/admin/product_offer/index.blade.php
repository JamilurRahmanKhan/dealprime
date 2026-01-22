@extends('admin.layouts.master')
@section('title')Product offers Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Product Offers Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Product Offers Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Product Offers Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('products_offers.create')
            <div class="my-1">
                <a  href="{{route('products_offers.create')}}">
                    <button class="btn btn-info"  data-bs-toggle="tooltip" data-bs-placement="top" title="Product Offer Create"><i class="fa-solid fa-square-plus"></i> Add </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Product Offers Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class=" table-responsive ">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Product Name</th>
                            <th>Discount Percentage </th>
                            <th>Status </th>
                            @if(auth()->user()->can('products_offers.edit') ||  auth()->user()->can('products_offers.show') || auth()->user()->can('products_offers.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($product_offers->count()>0)
                            @foreach($product_offers as $index=>$product_offer)
                                <tr>
                                    <td>{{$index +1}}</td>

                                    <td>{{ isset($product_offer->product->name) ? $product_offer->product->name : ' ' }}</td>

                                    <td>{{ $product_offer->discount_amount }}</td>
                                    <td>{{ $product_offer->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                    @if(auth()->user()->can('products_offers.edit') ||  auth()->user()->can('products_offers.show') || auth()->user()->can('products_offers.destroy') )
                                    <td>

                                        <!--edit-->
                                        @can('products_offers.edit')
                                        <a href="{{route('products_offers.edit',$product_offer->id)}}"
                                            class="btn btn-success btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Product Offer Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>
                                        <!--status-->
                                        @if ($product_offer->status==1)
                                        <a href="{{route('product_offer.status',$product_offer->id)}}"
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                            <i class="fa-solid fa-lock-open py-"></i>
                                        </a>
                                        @endif
                                        @if ($product_offer->status==0)
                                        <a href="{{route('product_offer.status',$product_offer->id)}}"
                                            class="btn btn-info btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                        @endif
                                        @endcan
                                        
                                        <!--Destroy-->
                                        @can('products_offers.destroy')
                                        <form action="{{route('products_offers.destroy',$product_offer->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Product Offer Delete"
                                             onclick="return confirm('Are you sure you want to delete this teacher?');">
                                                <i class="ri-chat-delete-fill"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="9" class="text-center">Offer product  not found </td>
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
