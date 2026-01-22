@extends('admin.layouts.master')
@section('title')Rating  Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Rating  Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Rating  Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Rating  Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            {{-- <div class="my-1">
                <a  href="">
                    <button class="btn btn-info"><i class="fa-solid fa-square-plus"></i> Add </button>
                </a>
            </div> --}}
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Rating  Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive  w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Product Name </th>
                            <th>Customer Email </th>
                            <th>Review  </th>
                            <th>Rating </th>
                            <th>Status </th>
                            @if(auth()->user()->can('rating.edit') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($ratings->count()>0)
                            @foreach($ratings as $index=>$rating)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$rating->product->name}}</td>
                                    <td>{{$rating->customer->name}}</td>
                                    <td>{!!$rating->review!!}</td>
                                    <td>{{$rating->rating}}</td>
                                    <td>{{$rating->status==1?'Published':'Unpublished'}}</td>

                                    @if(auth()->user()->can('rating.edit') )
                                    <td>
                                        <!--edit-->
                                        @can('rating.edit')
                                        @if ($rating->status==1)
                                        <a href="{{route('rating.show',$rating->id)}}"
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                            <i class="fa-solid fa-lock-open py-"></i>
                                        </a>
                                        @endif
                                        @if ($rating->status==0)
                                        <a href="{{route('rating.show',$rating->id)}}"
                                             class="btn btn-info btn-sm"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                        @endif
                                        @endcan
                                        {{-- <form action="{{route('rating.destroy',$rating->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this teacher?');">
                                                <i class="ri-chat-delete-fill"></i>
                                            </button>
                                        </form> --}}
                                    </td>
                                  @endif
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="text-center">Rating  not found </td>
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
