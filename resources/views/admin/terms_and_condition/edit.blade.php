@extends('admin.layouts.master')
@section('title')Terms & condition edit @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Terms & condition Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Terms & condition edit</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Terms & condition Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Terms & condition form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{route('terms.update',$term->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label for="terms_and_condition" class="col-md-3 col-form-label">Terms & condition  details</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="summernote" name="terms_and_condition" cols="3" rows="3" placeholder="Enter Terms & condition"  >{!!$term->terms_and_condition!!}</textarea>
                                <div class="text-danger">@error('terms_and_condition'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="BannerSubTitle" class="col-md-3 col-form-label">Terms Type</label>
                            <div class="col-md-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" 
                                        {{$term->terms_type == 1 && $term->user_type == $current_user_type ? 'checked' : 'disabled'}}  
                                        name="terms_type" 
                                        type="radio" 
                                        id="1" 
                                        value="1">
                                    <label class="form-check-label" for="1">Terms and Conditions</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" 
                                        {{$term->terms_type == 2 && $term->user_type == $current_user_type ? 'checked' : 'disabled'}} 
                                        name="terms_type" 
                                        type="radio" 
                                        id="2" 
                                        value="2">
                                    <label class="form-check-label" for="2">Return & Refund Policy</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" 
                                        {{$term->terms_type == 3 && $term->user_type == $current_user_type ? 'checked' : 'disabled'}} 
                                        name="terms_type" 
                                        type="radio" 
                                        id="3" 
                                        value="3">
                                    <label class="form-check-label" for="3">Privacy Policy </label>
                                </div> 
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="user_type" class="col-md-3 pt-0 col-form-label">User Type</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" 
                                        type="radio" 
                                        value="1" 
                                        {{$term->user_type == 1 ? 'checked' : 'disabled'}} 
                                        name="user_type"  
                                        id="status1">
                                    <label class="form-check-label" for="status1">
                                        Partner
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" 
                                        type="radio" 
                                        value="0"  
                                        {{$term->user_type == 0 ? 'checked' : 'disabled'}}   
                                        name="user_type" 
                                        id="status2">
                                    <label class="form-check-label" for="status2">
                                        Customer
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Update terms & condition</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>

    @include('admin.layouts.text-editor')

@endsection
