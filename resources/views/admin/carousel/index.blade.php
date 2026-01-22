@extends('admin.layouts.master')
@section('title')Carousel Manage  @endsection
@section('body')
<style>
</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Carousel Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Carousel Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Carousel Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('carousels.create')
            <div class="my-1">
                <a  href="{{route('carousels.create')}}">
                    <button class="btn btn-info"
                     data-bs-toggle="tooltip" data-bs-placement="top" title="Carousel Create" >
                     <i class="fa-solid fa-square-plus"></i> Add
                    </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Carousel Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Name </th>
                            <th>image </th>
                            <th>title </th>
                            <th>Status </th>
                            @if(auth()->user()->can('carousels.edit') || auth()->user()->can('carousels.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($carousels->count()>0)
                            @foreach($carousels as $index=>$carousel)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$carousel->product->name}}</td>
                                    <td><img src="{{asset($carousel->image)}}" style="width: 50px; height:50px"></td>
                                    <td>{!!$carousel->title!!}</td>
                                    <td>{{$carousel->status==1?'Published':'Unpublished'}}</td>

                                    @if(auth()->user()->can('carousels.edit') || auth()->user()->can('carousels.destroy') )
                                    <td>
                                        <!--edit-->
                                        @can('carousels.edit')
                                        <a href="{{route('carousels.edit',$carousel->id)}}"
                                             class="btn btn-success btn-sm"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Carousel Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>
                                        <!--status-->
                                        @if ($carousel->status==1)
                                        <a href="{{route('carousels.show',$carousel->id)}}"
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                            <i class="fa-solid fa-lock-open py-"></i>
                                        </a>
                                        @endif
                                        @if ($carousel->status==0)
                                        <a href="{{route('carousels.show',$carousel->id)}}"
                                            class="btn btn-info btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                        @endif
                                        @endcan

                                        <!--destroy-->
                                        {{-- @can('carousels.destroy')
                                        <form action="{{route('carousels.destroy',$carousel->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Carousel Delete"
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
                                <td colspan="6" class="text-center">Carousel not found !</td>
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
