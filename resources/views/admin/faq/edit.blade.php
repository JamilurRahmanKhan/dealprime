@extends('admin.layouts.master')
@section('title')Faqs Edit @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Faq Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Faq Edit</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Faq Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Faqs form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('faq.update',$faq->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label for="question" class="col-md-3 col-form-label">Question</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{old('question',$faq->question)}}" name="question" id="question" placeholder="Question ?"/>
                            <div class="text-danger">@error('question'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="answer" class="col-md-3 col-form-label">Answer</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="answer" cols="3" rows="3" placeholder="Answer" id="answer" >{!!$faq->answer!!}</textarea>
                                <div class="text-danger">@error('answer'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="status" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$faq->status==1?'checked':''}} type="radio" value="1" name="status"  id="status1">
                                    <label class="form-check-label" for="status1">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input"  {{$faq->status==0?'checked':''}} type="radio" value="0"  name="status" id="status2">
                                    <label class="form-check-label" for="status2">
                                        Unpublished
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Update Faq</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>


@endsection
