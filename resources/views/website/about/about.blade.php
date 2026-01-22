@extends('website.layouts.master')
@section('title','About')
@section('body')
<main class="main about">
    <div class="page-header  text-left" style="padding: 3rem  8.7rem;">
        <div class="container text-center"> <span>ABOUT US</span><br>
            <h1>

                OUR COMPANY
            </h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->


    <div class="about-section">
        <div class="container">
            @if($about)

            {!!$about->about!!}

            @else
                <div class="image-container" style="display: flex;justify-content: center;">
                    <img  src="{{asset('website/assets/images/notfound/2002.gif')}}" width="50%" height="50%" alt="">
                </div>
            @endif
        </div><!-- End .container -->
    </div><!-- End .about-section -->

</main>
@endsection
