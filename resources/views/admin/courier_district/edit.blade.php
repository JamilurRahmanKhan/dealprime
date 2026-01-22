@extends('admin.layouts.master')
@section('title')Courier District Edit @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('district.index')}}">Courier District Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Courier District Edit</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Courier District Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Courier District form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{route('district.update',$district->id)}}" method="POST">
                        @method('put')
                        @csrf

                        {{-- <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Division Name</label>
                            <div class="col-md-9">
                                <select class="form-control" name="division_id">
                                    <option  disabled >Select Division Name</option>
                                    @foreach ($divisions as $division )
                                    <option value="{{$division->id}}" {{$division->id==$district->division_id?'selected':''}} >{{$division->name}}</option>
                                    @endforeach
                                </select>
                            <div class="text-danger">@error('division_id'){{$message}} @enderror</div>
                            </div>
                        </div> --}}
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">District Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$district->name}}" name="name" id="name" placeholder="District Name"/>
                            <div class="text-danger">@error('name'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$district->status==1?'checked':''}} type="radio" value="1" name="status"  id="status1">
                                    <label class="form-check-label" for="status">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$district->status==0?'checked':''}} type="radio" value="0" name="status" id="status2">
                                    <label class="form-check-label" for="status">
                                        Unpublished
                                    </label>
                            </div>
                        </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>


@endsection
