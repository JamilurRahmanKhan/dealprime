@extends('admin.layouts.master')
@section('title')Product offers Create @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Product offers Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Product offers Add</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Product offers Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Add Product offers form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('products_offers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        

                          <!-- product name -->
                          <div class="row mb-3">
                            <label for="product" class="col-md-3 col-form-label">Product  Name</label>
                            <div class="col-md-9">
                                <div class="dropdown searchable-dropdown">
                                    <input type="text" id="search-input-product" class="form-control"
                                        placeholder="Select offer product" data-toggle="dropdown" readonly>
                                    <div class="dropdown-menu" aria-labelledby="search-input-product">
                                        <input type="text" id="option-search-input-product" class="form-control"
                                            placeholder="Search...">
                                        @foreach ($products as $product)
                                            <a class="dropdown-item product-item" data-id="{{$product->id}}">{{$product->name}}</a>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="text-danger">@error('product_id'){{ $message }}@enderror</div>
                            </div>
                            <input type="hidden" name="product_id" id="product-id">
                        </div>
                        {{-- <div class="row mb-3">
                            <label for="title" class="col-md-3 col-form-label">Title One</label>
                            <div class="col-md-9">
                                <input type="text" id="title" class="form-control" name="title_one" placeholder="Title one">
                                <div class="text-danger">@error('title_one'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-md-3 col-form-label">Title Two</label>
                            <div class="col-md-9">
                                <input type="text" id="title" class="form-control" name="title_two" placeholder="Title one">
                                <div class="text-danger">@error('title_two'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-md-3 col-form-label">Title Three</label>
                            <div class="col-md-9">
                                <input type="text" id="title" class="form-control" name="title_three" placeholder="Title one">
                                <div class="text-danger">@error('title_three'){{$message}} @enderror</div>
                            </div>
                        </div> --}}
                        <div class="row mb-3">
                            <label for="discount" class="col-md-3 col-form-label">Discount Percentage</label>
                            <div class="col-md-9">
                                <input type="text" id="discount" class="form-control" name="discount_amount" placeholder="Discount Percentage">
                                <div class="text-danger">@error('discount_amount'){{$message}} @enderror</div>
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label">Product Offers Description</label>
                            <div class="col-md-9">
                            <textarea class="form-control" name="description" id="description" cols="3" rows="3" placeholder="Product Offers Description"></textarea>
                            <div class="text-danger">@error('description'){{$message}} @enderror</div>
                            </div>
                        </div> --}}
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
                            <div class="col-9 mt-2">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>

    <script>
        $(document).ready(function() {
            $('.product-item').on('click', function(e) {
                e.preventDefault();

                var productName = $(this).text();
                var productId = $(this).data('id');
                $('#search-input-product').val(productName);

                $('#product-id').val(productId);
            });
        });
    </script>


@endsection
