@extends('website.layouts.master')
@section('title','terms and condition')
@section('body')
<main class="main about">
    @if($terms_and_condition)
    <div class="page-header page-header-bg text-left">
        <div class="container text-center">
            <h1>
                @if($terms_and_condition->terms_type == 1)
                    TERMS AND CONDITION
                @elseif($terms_and_condition->terms_type == 2)
                    Return & Refund Policy
                @elseif($terms_and_condition->terms_type == 3)
                    Privacy Policy
                @endif
            </h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    @endif
    <div class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" style="width:100%">
                    
                    @if($terms_and_condition)
                        {!!$terms_and_condition->terms_and_condition!!}
                    @else
                        <div class="image-container" style="display: flex;justify-content: center;">
                            <img  src="{{asset('website/assets/images/notfound/no-data-found.avif')}}" width="30%" height="30%" alt="">
                        </div>
                    @endif
                </div>
            </div>
            
        </div><!-- End .container -->
    </div><!-- End .about-section -->


</main>
@endsection
