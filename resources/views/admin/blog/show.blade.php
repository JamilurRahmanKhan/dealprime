@extends('admin.layouts.master')
@section('title')
    Blog Details
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blog Manage</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Blog Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">Blog Detail Information
                        <span class="float-end">
                            <!--index-->
                            @can('blogs.index')
                            <a href="{{ route('blogs.index') }}">
                                <button class="btn btn-sm btn-primary"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Back To Manage">
                                  <i class="fa-solid fa-arrow-rotate-left"></i>
                                </button>
                            </a>
                            @endcan
                            <!--edit-->
                            @can('blogs.edit')
                            <a href="{{ route('blogs.edit', $blog->id) }}">
                                <button class="btn btn-sm btn-info"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Blog Edit">
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
                            <th>Blog Id</th>
                            <td>{{$blog->id}}</td>
                        </tr>
                        <tr>
                            <th>Blog Category</th>
                            <td>{{$blog->blogCategory->name}}</td>
                        </tr>
                        <tr>
                            <th>Blog Tag</th>
                            <td>
                                @foreach ($blog->postTag as $postTag)
                                <span>{{ $postTag->blogTag->name . ', ' }} </span>
                                @endforeach
                            </td>
                        </tr>

                        <tr>
                            <th>Created By</th>
                            <td>{{$blog->created_by}}</td>
                        </tr>
                        <tr>
                            <th>Crated Date</th>
                            <td>{{ \Carbon\Carbon::parse($blog->created_time)->format('F j, Y') }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{$blog->title}}</td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td>{!!$blog->short_description!!}</td>
                        </tr>
                        <tr>
                            <th>Long Description</th>
                            <td>{!!$blog->long_description!!}</td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td><img src="{{ asset($blog->image) }}" alt="" height="50" width="50" /></td>
                        </tr>
                        <tr>
                            <th>Publication Status</th>
                            <td>
                                {{ $blog->status == 1 ? 'Published' : 'Not Published' }}
                            </td>
                        </tr>


                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
