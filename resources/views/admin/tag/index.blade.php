@extends('admin.layouts.master')
@section('title')Tags Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Tags Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Tag Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Tag Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            @can('tags.create')
            <div class="my-1">
                <a  href="{{route('tags.create')}}">
                    <button class="btn btn-info"   data-bs-toggle="tooltip" data-bs-placement="top" title="Tag Create"><i class="fa-solid fa-square-plus"></i> Add </button>
                </a>
            </div>
            @endcan
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Tags Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Name </th>
                            <th>Status </th>
                            @if(auth()->user()->can('tags.edit') || auth()->user()->can('tags.destroy') )
                            <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @if ($tags->count()>0)
                            @foreach($tags as $index=>$tag)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$tag->name}}</td>
                                    <td>
                                        @if ($tag->status==1)
                                        <span class="badge p-1 bg-success">Published</span>
                                        @else
                                        <span class="badge p-1 bg-danger">Unpublished</span>
                                        @endif
                                    </td>
                                    @if(auth()->user()->can('tags.edit') || auth()->user()->can('tags.destroy') )
                                    <td>
                                        <!--edit-->
                                        @can('tags.edit')
                                        <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-success btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Tag Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>
                                        <!--status-->
                                        @if ($tag->status==1)
                                        <a href="{{route('tags.show',$tag->id)}}"
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                            <i class="fa-solid fa-lock-open py-"></i>
                                        </a>
                                        @endif
                                        @if ($tag->status==0)
                                        <a href="{{route('tags.show',$tag->id)}}" class="btn btn-info btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                        @endif
                                        @endcan
                                        <!--destroy-->
                                        {{-- @can('tags.edit')
                                        <form action="{{route('tags.destroy',$tag->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Tag Delete"
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
                                <td colspan="4" class="text-center">Tag not found </td>
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
