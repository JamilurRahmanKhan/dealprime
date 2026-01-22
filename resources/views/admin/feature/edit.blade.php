@extends('admin.layouts.master')
@section('title')Feature Edit @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('features.index')}}">Fetures Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Feture Edit</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Feature Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Features form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('features.update',$feature->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label">Feature Image</label>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="imageInput" name="image">
                                    <div class="text-danger">@error('image'){{$message}} @enderror</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <img id="imagePreview" src="{{ asset($feature->image) }}" alt="Your Image" class="img-fluid" style="display: {{ $feature->image ? 'block' : 'none' }};"/>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Feature Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" value="{{$feature->name}}" id="name" value="{{old('name')}}" placeholder="Features Name"/>
                            <div class="text-danger">@error('name'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$feature->satus==1?'checked':''}} type="radio" value="1" name="status" checked
                                        id="status1">
                                    <label class="form-check-label" for="status">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$feature->satus==0?'checked':''}} type="radio" value="0" name="status" id="status2">
                                    <label class="form-check-label" for="status">
                                        Unpublished
                                    </label>
                            </div>
                        </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9 mt-2">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>


@endsection
