@extends('admin.layouts.master')
@section('title')policy Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">policy Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">policy Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">policy Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            {{-- @can('policy.create') --}}
            <div class="my-1">
                <a  href="{{route('policy.create')}}">
                    <button class="btn btn-info"   data-bs-toggle="tooltip" data-bs-placement="top" title="policy Create"><i class="fa-solid fa-square-plus"></i> Add </button>
                </a>
            </div>
            {{-- @endcan --}}
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All policy Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Policy image </th>
                            <th>policy title </th>
                            <th> Policy sub title </th>
                            {{-- @if(auth()->user()->can('policy.edit') || auth()->user()->can('policy.destroy') ) --}}
                            <th>Action</th>
                            {{-- @endif --}}
                        </tr>
                        </thead>
                        <tbody>
                            @if ($policys->count()>0)
                            @foreach($policys as $index=>$policy)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>
                                        @if ($policy->image)
                                        <img src="{{asset($policy->image)}}" style="width: 50px; height:50px">
                                        @else
                                        <img src="{{asset('admin')}}/assets/not-found/notfound.jpeg" alt="NO image" style="width: 50px; height:50px">
                                        @endif
                                    </td>
                                    <td>{!!$policy->title!!}</td>
                                    <td>{!!$policy->sub_title!!}</td>


                                    {{-- @if(auth()->user()->can('policy.edit') || auth()->user()->can('policy.destroy') ) --}}
                                    <td>
                                        <!--edit-->
                                        {{-- @can('policy.edit') --}}
                                        <a href="{{route('policy.edit',$policy->id)}}"
                                             class="btn btn-success btn-sm"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="policy Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>
                                        {{-- @endcan --}}
                                        <!--Destroy-->
                                        {{-- @can('policy.destroy')
                                        <form action="{{route('policy.destroy',$policy->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="policy Delete"
                                             onclick="return confirm('Are you sure you want to delete this teacher?');">
                                                <i class="ri-chat-delete-fill"></i>
                                            </button>
                                        </form>
                                        @endcan --}}
                                    </td>
                                    {{-- @endif --}}
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6" class="text-center">policy not found </td>
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
