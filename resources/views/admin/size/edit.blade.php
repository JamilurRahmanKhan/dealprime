@extends('admin.layouts.master')
@section('title')Sizes Edit @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('sizes.index')}}">Size Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Size Edit</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Size Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Sizes form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('sizes.update',$size->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Size Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$size->name}}" value="{{old('name')}}" name="name" id="name" placeholder="Size Name"/>
                            <div class="text-danger">@error('name'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="code" class="col-md-3 col-form-label">Size Code</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$size->code}}" value="{{old('code')}}" name="code" id="code" placeholder="Size Code"/>
                            <div class="text-danger">@error('code'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label">Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" cols="3" rows="3" placeholder="Size Description" id="description" value={{old('description')}}>{!!$size->description!!}</textarea>
                                <div class="text-danger">@error('description'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1"  {{$size->status==1?'checked':''}}  name="status"  id="status1">
                                    <label class="form-check-label" for="status1">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0"  {{$size->status==0?'checked':''}}  name="status" id="status2">
                                    <label class="form-check-label" for="status2">
                                        Unpublished
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Update size</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>


@endsection
