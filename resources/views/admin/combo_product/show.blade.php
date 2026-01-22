@extends('admin.layouts.master')
@section('title')Combo Product Show  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('combo_product.index')}}">Combo Product Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Combo Product Show</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Combo Product  Module</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header border-bottom">
                <h3 class="card-title">Combo Product  Information
                    <span class="float-end">
                        @can('combo_product.index')
                        <!--index-->
                        <a href="{{route('combo_product.index')}}">
                          <button class="btn btn-sm btn-primary"
                          data-bs-toggle="tooltip" data-bs-placement="top" title="Back to Home">
                              <i class="fa-solid fa-arrow-rotate-left"></i>
                          </button>
                      </a>
                        @endcan
                        @can('combo_product.edit')
                        <!--edit-->
                        <a href="{{route('combo_product.edit',$combo->id)}}">
                         <button class="btn btn-sm btn-info"
                         data-bs-toggle="tooltip" data-bs-placement="top" title="Combo Product Edit">
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
                        <th>Id</th>
                        <td>{{$combo->id}}</td>
                    </tr>
                    <tr>
                        <th>Combo Title</th>
                        <td>{{$combo->name}}</td>
                    </tr>

                    <tr>
                        <th>Product Image</th>
                        <td><img src="{{asset($combo->image)}}" alt="" height="40" width="60"/></td>
                    </tr>
                    <tr>
                        <th>Combo Products Name</th>
                        <td>
                            <ol>
                                @foreach ($combo->comboDetails as $detail)
                                    <li>{{ $detail->product->name }}</li>
                                @endforeach
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <th>Stock Amount</th>
                        <td>{{number_format($combo->stock_amount)}}</td>
                    </tr>
                    <tr>
                        <th>Reguler Price</th>
                        <td>{{number_format($combo->regular_price)}}</td>
                    </tr>
                    <tr>
                        <th>Discount Amount</th>
                        <td>{{number_format($combo->discount_amount)}} {{$combo->discount_type=='percentage'?'%':'Tk'}} </td>
                    </tr>
                    <tr>
                        <th>Selling Price</th>
                        <td>{{number_format($combo->selling_price)}}</td>
                    </tr>
                    <tr>
                        <th>Short Description</th>
                        <td>{!!$combo->short_description!!}</td>
                    </tr>
                    <tr>
                        <th>Long Description</th>
                        <td>{!!$combo->long_description!!}</td>
                    </tr>
                    <tr>
                        <th>Publication Status</th>
                        <td>
                            {{ $combo->status == 1 ? "Published" : "Not Published" }}
                        </td>
                    </tr>


                </table>
            </div>
        </div>
    </div>
</div>
@endsection
