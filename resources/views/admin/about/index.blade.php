@extends('admin.layouts.master')
@section('title')
    About Manage
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">About Module</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About Manage</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">About Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            {{-- @can('abouts.create') --}}
                <!--create-->
                <div class="my-1">
                    <a href="{{ route('abouts.create') }}">
                        <button class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Color Create"><i
                                class="fa-solid fa-square-plus"></i> Add </button>
                    </a>
                </div>
            {{-- @endcan --}}
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All abouts Information</h4>
                    <p class="text-muted font-14">{{ Session::get('success') }}</p>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped dt-responsive  w-100">
                            <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>About details</th>
                                    <th>status </th>
                                    {{-- @if (auth()->user()->can('abouts.edit') || auth()->user()->can('abouts.destroy')) --}}
                                        <th>Action</th>
                                    {{-- @endif --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if ($abouts->count() > 0)
                                    @foreach ($abouts as $index => $about)
                                    <tr>
                                        <td>{{$index +1}}</td>

                                        <td>{!!$about->about!!}</td>
                                        <td>
                                            @if ($about->status==1)
                                            <span class="badge p-1 bg-success">Published</span>
                                            @else
                                            <span class="badge p-1 bg-danger">Unpublished</span>
                                            @endif
                                        </td>


                                       @if(auth()->user()->can('abouts.edit') || auth()->user()->can('abouts.destroy') ) 
                                        <td>
                                            <!--edit-->
                                            @can('abouts.edit') 
                                            <a href="{{route('abouts.edit',$about->id)}}"
                                                 class="btn btn-success btn-sm"
                                                 data-bs-toggle="tooltip" data-bs-placement="top" title="Banner Edit">
                                                <i class="ri-edit-box-fill"></i>
                                            </a>
                                            @endcan 
                                            <!--status-->
                                        @if ($about->status==1)
                                        <a href="{{route('abouts.show',$about->id)}}"
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                            <i class="fa-solid fa-lock-open py-"></i>
                                        </a>
                                        @endif
                                        @if ($about->status==0)
                                        <a href="{{route('abouts.show',$about->id)}}"
                                             class="btn btn-info btn-sm"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                        @endif
                                            {{-- @endcan --}}
                                            <!--Destroy-->
                                            {{-- @can('banner.destroy')
                                            <form action="{{route('Banner.destroy',$Banner->id)}}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Banner Delete"
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
                                        <td colspan="6" class="text-center">Abouts not found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection
