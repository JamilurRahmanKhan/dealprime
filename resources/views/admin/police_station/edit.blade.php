@extends('admin.layouts.master')
@section('title')Courier Police Station Edit @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('police_station.index')}}">Courier Police Station Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Courier Police Station Edit</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Courier Police Station Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Courier Police Station form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{route('police_station.update',$station->id)}}" method="POST">
                        @csrf
                        @method('put')

                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">District  Name</label>
                            <div class="col-md-9">
                                <select class="form-control" name="district_id" >
                                    <option disabled>Select District</option>
                                    @foreach ($districts as $district )
                                    <option value="{{$district->id}}" {{$district->id==$station->district_id?'selected':''}}>{{$district->name}}</option>
                                    @endforeach
                                </select>
                            <div class="text-danger">@error('district_id'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Police Station Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$station->name}}" name="name" id="name" placeholder="Police Station Name"/>
                            <div class="text-danger">@error('name'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$station->status==1?'checked':''}} type="radio" value="1" name="status"
                                        id="status1">
                                    <label class="form-check-label" for="status">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$station->status==0?'checked':''}}  type="radio" value="0" name="status" id="status2">
                                    <label class="form-check-label" for="status">
                                        Unpublished
                                    </label>
                            </div>
                        </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Update Station</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>


@endsection
