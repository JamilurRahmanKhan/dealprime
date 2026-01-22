@extends('website.layouts.master')
@section('title','Contact')
@section('body')

    <main class="main">
        <div class="container reset-password-container mt-5">
            <div class="row">
                <div class="col-12">
                    @error('message') {{$message}}@enderror
                </div>
                <div class="col-lg-6 offset-lg-3">
                    <div class="feature-box border-top-primary">
                        <div class="feature-box-content">
                            <form class="mb-0" action="{{ route('send.opt') }}" method="post">
                                @csrf
                                <p>
                                    Lost your password? Please enter your
                                    registered phone number. You will receive
                                    an OTP create a new password via phone number.
                                </p>
                                <div class="form-group mb-0">
                                    <label for="reset-email" class="font-weight-normal">Phone Number</label>
                                    <input type="text" class="form-control" id="reset-email" name="phone"
                                           required />
                                </div>

                                <div class="form-footer mb-0">
                                    <a href="{{route('customer.login')}}">Click here to login</a>

                                    <button type="submit"
                                            class="btn btn-md btn-primary form-footer-right font-weight-normal text-transform-none mr-0">
                                        Request OTP
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End .main -->

@endsection
