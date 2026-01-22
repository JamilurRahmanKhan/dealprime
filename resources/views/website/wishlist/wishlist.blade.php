@extends('website.layouts.master')
@section('title','Wishlist')
@section('body')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Wishlist
                        </li>
                    </ol>
                </div>
            </nav>
            <h1>Wishlist</h1>
        </div>
    </div>

    <div class="container ">
        <div class="wishlist-table-container ">
            <table class="table table-wishlist mb-0 mt-3">
                @if(count($wishlists) > 0)
                <thead>
                    <tr>
                        <th class="thumbnail-col"></th>
                        <th class="product-col">Product</th>
                        <th class="price-col">Price</th>
                        <th class="status-col">Stock Status</th>
                        <th class="action-col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($wishlists as $wishlist)
                        @if ($wishlist->customer_id == Auth::guard('customer')->id())

                            <tr class="product-row">
                            <td>
                                <figure class="product-image-container">
                                    <a href="{{ route('product_item.details', ['id' => $wishlist->product_id, 'category_id' => $wishlist->product->category_id]) }}" class="product-image">
                                        <img src="{{asset($wishlist->product->image)}}" alt="product">
                                    </a>

                                    <a href="{{route('wishlist.delete',$wishlist->id)}}" class="btn-remove icon-cancel" title="Remove Product"></a>
                                </figure>
                            </td>
                            <td>
                                <h5 class="product-title">
                                    <a href="{{ route('product_item.details', ['id' => $wishlist->product_id, 'category_id' => $wishlist->product->category_id]) }}">{{$wishlist->product->name}}</a>
                                </h5>
                            </td>
                            <td class="price-box">
                                {{-- {{number_format($wishlist->product->selling_price) }}tk --}}
                                @if ($wishlist->product->productOffer)
                                {{number_format($wishlist->product->selling_price - $wishlist->product->selling_price * ($wishlist->product->productOffer->discount_amount/100)) }} tk
                                @else
                                {{number_format($wishlist->product->selling_price) }} tk
                                @endif
                                @if ($wishlist->product->productOffer)
                                <span class="badge badge-danger"> - {{$wishlist->product->productOffer->discount_amount}} %</span>
                                @endif
                            </td>
                            <td>
                                <span class="stock-status">{{$wishlist->product->stock_amount == 0?'Stock out':'In Stock'}}</span>
                            </td>
                            <td class="action">
                                <a href="{{ route('product_item.details', ['id' => $wishlist->product_id, 'category_id' => $wishlist->product->category_id]) }}" class="btn btn-dark btn-add-cart btn-shop">
                                     details
                                </a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
                @else
                    <tr class="product-row ">
                        <td style="display: flex; justify-content: center; align-items: center; border:0px">
                            <h4 style="color:gray;margin: 0px">Wishlist is empty</h4>
                        </td>
                    </tr>
                    <tr class="product-row m-auto">
                        <td style="display: flex; justify-content: center; align-items: center;border:0px">
                            <figure class="product-image-container">
                                <img style="" src="{{asset('website/assets/images/not-found.png')}}" alt="product">
                            </figure>
                        </td>
                    </tr>
                @endif
            </table>

        </div><!-- End .cart-table-container -->
    </div><!-- End .container -->
</main>
@endsection
