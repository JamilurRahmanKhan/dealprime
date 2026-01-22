@extends('admin.layouts.master')
@section('title')
    Products Details
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product Manage</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Product Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Product Detail Information
                        <span class="float-end">
                            <!--index-->
                            @can('products.index')
                            <a href="{{ route('products.index') }}">
                                <button class="btn btn-sm btn-primary"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Back To Home">
                                <i class="fa-solid fa-arrow-rotate-left"></i>
                                </button>
                            </a>
                            @endcan
                            <!--edit-->
                            @can('products.edit')
                            <a href="{{ route('products.edit', $product->id) }}">
                                <button class="btn btn-sm btn-info"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Product Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </a>
                            @endcan
                        </span>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Product ID</th>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th>Product Name</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Product Code</th>
                            <td>{{ $product->code }}</td>
                        </tr>
                        <tr>
                            <th>Product Image</th>
                            <td>
                                <img src="{{ asset($product->image) }}" alt="" height="40" width="60" />
                            </td>
                        </tr>
                        <tr>
                            <th>Product Other Image</th>
                            <td>
                                @foreach ($product->productImages as $productImage)
                                    <img src="{{ asset($productImage->image) }}" alt="" height="40"
                                        width="60" />
                                @endforeach
                            </td>


                        </tr>
                        <!--nayem start-->
                        <tr>
                            <th>Other Image </th>
                            <td>
                                <img src="{{ asset($product->image_one) }}" alt="" height="40" width="60" />
                                <img src="{{ asset($product->image_two) }}" alt="" height="40" width="60" />
                                <img src="{{ asset($product->image_three) }}" alt="" height="40" width="60" />
                                <img src="{{ asset($product->image_four) }}" alt="" height="40" width="60" />
                            </td>
                        </tr>
                        <!--Nayem end-->
                        <tr>
                            <th>Category Name</th>
                            <td>{{ $product->category->name }}</td>
                        </tr>
                        <tr>
                            <th>Sub Category Name</th>
                            <td>{{ $product->subCategory->name }}</td>

                        </tr>
                        <tr>
                            <th>Sub Sub-Category Name</th>
                            <td>{{ $product->sub_subcategory->name }}</td>
                        </tr>
                        <tr>
                            <th>Brand Name</th>
                            <td>{{ $product->brand->name }}</td>
                        </tr>
                        <tr>
                            <th>Unit Name</th>
                            <td>{{ $product->unit->name }}</td>
                        </tr>
                        <tr>
                            <th>Product Color</th>
                            <td>
                                @foreach ($product->colors as $color)
                                    <span>{{ $color->color->name . ' , ' }} </span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Product Size</th>
                            <td>
                                @foreach ($product->sizes as $size)
                                    <span>{{ $size->size->name . ', ' }} </span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Product Tag</th>
                            <td>
                                @foreach ($product->tag as $tags)
                                    <span>{{ $tags->tag->name . ', ' }} </span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td>
                                {!! $product->short_description !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Long Description</th>
                            <td>
                                {!! $product->long_description !!}
                            </td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>
                                <span> Regular Price : {{number_format($product->regular_price)  }}</span> <br />
                                <span> Selling Price : {{number_format($product->selling_price ) }}</span>
                            </td>
                        </tr>

                        <tr>
                            <th>Stock Amount</th>
                            <td>
                                {{ $product->stock_amount }}
                            </td>
                        </tr>

                        <tr>
                            <th>Total View</th>
                            <td>
                                {{ $product->hit_count }}
                            </td>
                        </tr>

                        <tr>
                            <th>Total Sale</th>
                            <td>
                                {{ $product->sales_count }}
                            </td>
                        </tr>
                        <tr>
                            <th>Product Type</th>
                            <td>
                               @if ($product->type==1)
                               Hot
                               @elseif ($product->type==2)
                               Latest
                               @elseif ($product->type==3)
                               Popular
                               @elseif ($product->type==4)
                               Recommendation for you
                               @elseif ($product->type==5)
                               DealPrime picks
                               @elseif ($product->type==6)
                               Feature
                               @elseif ($product->type==7)
                               Seasonal Favourite
                               @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Flash Sale</th>
                            <td>
                                {{ $product->status == 1 ? 'On' : 'Off' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Publication Status</th>
                            <td>
                                {{ $product->status == 1 ? 'Published' : 'Unpublished' }}
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
