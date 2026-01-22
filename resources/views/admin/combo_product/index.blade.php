@extends('admin.layouts.master')
@section('title')Combo Product Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Combo Product Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Combo Product Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Combo Product Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('combo_product.create')
            <div class="my-1">
                <a  href="{{route('combo_product.create')}}">
                    <button class="btn btn-info"
                     data-bs-toggle="tooltip" data-bs-placement="top" title="Combo Product Create">
                     <i class="fa-solid fa-square-plus"></i> Add
                    </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Combo Product Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive  w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th> Combo Product Image </th>
                            <th>Title </th>
                            <th>Code </th>
                            <th>Discount Type </th>
                            <th>Reguller Price </th>
                            <th>Discount Amount </th>
                            <th>Selling Price </th>
                            <th>Status </th>
                            @if(auth()->user()->can('combo_product.edit') || auth()->user()->can('combo_product.destroy')||auth()->user()->can('combo_product.show') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($combos->count()>0)
                            @foreach($combos as $index=>$combo)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td><img src="{{ asset($combo->image) }}" style="width: 50px; height:50px"></td>
                                    <td>{{$combo->name}}</td>
                                    <td>{{$combo->code}}</td>
                                    <td>{{$combo->discount_type}}</td>
                                    <td>{{number_format($combo->regular_price)}}</td>
                                    <td>{{number_format($combo->discount_amount)}} {{$combo->discount_type=='percentage'?'%':'Tk'}}</td>
                                    <td>{{number_format($combo->selling_price) }}</td>
                                    <td>{{$combo->status==1?'Published':'Unpublished'}}</td>
                                    @if(auth()->user()->can('combo_product.edit') || auth()->user()->can('combo_product.destroy')||auth()->user()->can('combo_product.show') )
                                    <td>
                                        @can('combo_product.edit')
                                        <!--edit-->
                                        <a href="{{route('combo_product.edit',$combo->id)}}"
                                            class="btn btn-success btn-sm mb-1"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Combo Product Edit">
                                           <i class="ri-edit-box-fill"></i>
                                       </a>
                                         <!--status-->
                                       @if ($combo->status==1)
                                       <a href="{{route('combo_product.status',$combo->id)}}"
                                           class="btn btn-warning btn-sm mb-1"
                                           data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                           <i class="fa-solid fa-lock-open py-"></i>
                                       </a>
                                       @endif
                                       @if ($combo->status==0)
                                       <a href="{{route('combo_product.status',$combo->id)}}"
                                            class="btn btn-info btn-sm mb-1"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                           <i class="fa-solid fa-lock"></i>
                                       </a>
                                       @endif
                                        @endcan

                                        @can('combo_product.show')
                                        <!--show-->
                                        <a href="{{ route('combo_product.show', $combo->id) }}"
                                            class="btn btn-primary btn-sm mb-1"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Combo Product Show">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @endcan

                                        <!--destroy-->
                                        {{-- @can('combo_product.destroy')
                                        <form action="{{route('combo_product.destroy',$combo->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mb-1"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Combo Product Delete"
                                             onclick="return confirm('Are you sure you want to delete this teacher?');">
                                                <i class="ri-chat-delete-fill"></i>
                                            </button>
                                        </form>
                                        @endcan --}}
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="10" class="text-center">Combo Product not found </td>
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
