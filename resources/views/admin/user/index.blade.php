@extends('admin.layouts.master')
@section('title')User Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Manage User </li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">User Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
             <!--create-->
             @can('user.create')
             <div class="my-1">
                 <a href="{{route('user.create')}}">
                     <button class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="User Create"><i class="fa-solid fa-square-plus"></i> Add </button>
                 </a>
             </div>
             @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All User Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>User Image</th>
                            <th>User Name</th>
                            <th>Shop Holder Info</th>
                            <th>Role  </th>
                            <th>Status</th>
                            @if(auth()->user()->can('user.edit') || auth()->user()->can('user.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index=> $user )
                        <tr>
                            <td>{{$index +1 }}</td>
                            <td>
                                <img src="{{asset($user->profile_photo_path)}}" style="height: 60px; width:60px;" alt="User-image">
                            </td>
                            <td>{{$user->name}}</td>
                            <td>
                               Email: {{$user->email}} <br>
                               Shop: {{$user->shop_name}}<br>
                               Phone: {{$user->phone}}
                            </td>
                            <td>
                                @if ($user->role)
                                <span class="badge bg-primary text-dark" style="font-size:12px">{{$user->role}}</span>
                                @else
                                <span class="badge bg-danger" style="font-size:12px">Requesting</span>
                                @endif

                            </td>
                            <td>
                                @if ($user->status==1)
                                <span class="badge bg-info text-dark">Active</span>
                                @else
                                <span class="badge bg-warning text-dark">Deactive</span>
                                @endif
                            </td>

                            @if(auth()->user()->can('user.edit') || auth()->user()->can('user.destroy') )
                                <td>
                                    <!--edit-->
                                    @can('user.edit')
                                    <a href="{{route('user.edit',$user->id)}}"
                                        class="btn btn-success btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="User Edit">
                                        <i class="ri-edit-box-fill"></i>
                                    </a>
                                    @endcan
                                    <!--Status-->
                                    @can('user.edit')
                                    @if ($user->status==1)
                                    <a href="{{route('user.show',$user->id)}}" class="btn btn-warning btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                        <i class="fa-solid fa-lock-open py-"></i>
                                    </a>
                                    @endif
                                    @if ($user->status==0)
                                    <a href="{{route('user.show',$user->id)}}" class="btn btn-info btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                        <i class="fa-solid fa-lock"></i>
                                    </a>
                                    @endif
                                    <!--//Status-->
                                    @endcan
                                    <!--destroy-->
                                    {{-- @can('user.destroy')
                                    <form action="{{route('user.destroy',$user->id)}}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="User Delete"
                                        onclick="return confirm('Are you sure you want to delete this teacher?');">
                                            <i class="ri-chat-delete-fill"></i>
                                        </button>
                                    </form>
                                    @endcan --}}
                                </td>
                            @endif
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>
@endsection
