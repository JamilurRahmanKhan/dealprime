@extends('admin.layouts.master')
@section('title')Role Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Role Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Role Manage </li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Role Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('role.create')
            <div class="my-1">
                <a href="{{route('role.create')}}">
                    <button class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Role Create"><i class="fa-solid fa-square-plus"></i> Add </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Role Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Role Name</th>
                            <th>Description</th>
                            @if(auth()->user()->can('role.edit') || auth()->user()->can('role.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($roles->count())
                            @foreach($roles as $index=>$role)
                            <tr>
                                <td>{{$index +1}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->description}}</td>
                                @if(auth()->user()->can('role.edit') || auth()->user()->can('role.destroy') )
                                <td>
                                    <!-- Edit Button -->
                                    @can('role.edit')
                                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Role Edit">
                                        <i class="ri-edit-box-fill"></i>
                                    </a>
                                    @endcan

                                    <!-- Destroy Button (only if role is not Admin) -->
                                    @if ($role->name !== 'Admin')
                                    @can('role.destroy')
                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Role Delete" onclick="return confirm('Are you sure you want to delete this teacher?');">
                                            <i class="ri-chat-delete-fill"></i>
                                        </button>
                                    </form>
                                    @endcan
                                    @endif
                                </td>

                                @endif
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4">Opps! Role Not Found.</td>
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
