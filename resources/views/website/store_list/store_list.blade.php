@extends('website.layouts.master')
@section('title','Partner List')
@section('body')
<main class="main about">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
{{--                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>--}}
                        <li class="breadcrumb-item active" aria-current="page">
                            Partner list
                        </li>
                    </ol>
                </div>
            </nav>
            <h1>All Partner list</h1>
        </div>
    </div>
    <div class="about-section">
        <div class="container">
            <div class="row">
                @foreach ($storeLists as $list )
                <div class="col-md-3">
                    <div class="card">
                        <div class="justify-content-center container">
                            <a href="{{ route('shop_product.list',[ $list->id,'merchant']) }}">
                                <div class="card-body text-center">
                                     <img
                                        src="{{asset('website')}}/assets/images/notfound/sotre-image-notf.webp"
                                        class="rounded-circle mx-auto d-block"
                                        alt="..."
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                        <hr style="margin: 0">
                                        <div class="my-2">
                                            <p class="m-0">{{$list->name}}</p>
                                            <p class="p-0">{{$list->email}}</p>
                                        </div>

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection
