<section class="intro-section">
    <div class="home-slider owl-carousel owl-theme loaded slide-animate mb-4"
        data-owl-options="{
        'dots' : true,
    'nav': false,
    'lazyLoad': false
}">
    @foreach ($heroContents as $heroContent)

    <div class="home-slide home-slide-1 banner" style="background-color: #d9e2e1;">
        <figure>
            <img src="{{ asset($heroContent->image) }}" alt="slide"
                 >
        </figure>

        <div class="banner-layer banner-layer-middle banner-layer-left">
            <h4 class="font-weight-normal text-body m-b-2 appear-animate " data-animation-name="fadeInDownShorter"
                data-animation-delay="100">{{$heroContent->product->name}}
            </h4>
            <h2 class="appear-animate c-h-2" data-animation-name="fadeInUpShorter" data-animation-delay="600">{{$heroContent->title}}</h2>
            <div class="position-relative appear-animate" data-animation-name="fadeInRightShorter"
                data-animation-delay="1100">
                <p class="text-uppercase mb-2 c-d-none">{{$heroContent->short_details}}</p>
            </div>
            <div>
                 <a href="{{ route('product_item.details', ['id' => $heroContent->product_id, 'category_id' => $heroContent->product->category_id]) }}">
                    <button class="btn btn-primary  position-relative appear-animate " data-animation-name="fadeInRightShorter"
                    data-animation-delay="1100">Buy now</button></a>
            </div>
        </div>


    </div>
    @endforeach

    </div>
</section>
