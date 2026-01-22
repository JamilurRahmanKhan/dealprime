@extends('website.layouts.master')
@section('title','Faq')
@section('body')
<main class="main about">
    <div class="page-header  text-left" style="padding: 3rem  8.7rem;">
        <div class="container text-center"> <span>FAQ</span><br>
            <h3>Frequently Asked Questions</h3>
        </div><!-- End .container -->
    </div><!-- End .page-header -->

    <div class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt-8" id="accordion2">
                        @if($faqs)
                            @foreach ($faqs as $faq )
                                <div class="card card-accordion accordion-boxed">
                                    <a class="card-header collapsed" href="#" data-toggle="collapse" data-target="#collapse{{$faq->id}}"
                                       aria-expanded="true" aria-controls="collapse{{$faq->id}}">
                                        {{$faq->question}}
                                    </a>

                                    <div id="collapse{{$faq->id}}" class="collapse" data-parent="#accordion2">
                                        <p>{!!$faq->answer!!}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="image-container" style="display: flex;justify-content: center;">
                                <img  src="{{asset('website/assets/images/notfound/2002.gif')}}" width="50%" height="50%" alt="">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div><!-- End .container -->
    </div><!-- End .about-section -->

</main>
@endsection
