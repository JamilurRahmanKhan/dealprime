@extends('website.layouts.master')
@section('title', 'Confirmation')
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 mt-5"  >
                <div class="card bg-danger" style="border-radius: 7px !important;">
                    <div class="card-body" style="min-height: 50px !important; height: 75px !important;">
                        <h3 class="text-center" style="color: #fff;">{{ session('message') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
