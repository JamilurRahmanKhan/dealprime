@extends('website.layouts.master')
@section('title','Customer Authentication')
@section('body')
    <main class="main">
{{--        <div class="page-header">--}}
{{--            <div class="container d-flex flex-column align-items-center">--}}
{{--                <nav aria-label="breadcrumb" class="breadcrumb-nav">--}}
{{--                    <div class="container">--}}
{{--                        <ol class="breadcrumb">--}}
{{--                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>--}}
{{--                            <li class="breadcrumb-item active" aria-current="page">--}}
{{--                                My Account--}}
{{--                            </li>--}}
{{--                        </ol>--}}
{{--                    </div>--}}
{{--                </nav>--}}

{{--                <h1>My Account</h1>--}}
{{--            </div>--}}
{{--        </div>--}}
        <style>
            .password-input-container {
                position: relative;
                width: 100%; /* Adjust as needed */
            }

            .toggle-password {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-10%);
                cursor: pointer;
                color: #666; /* Icon color */
            }

            .toggle-password:hover {
                color: #000; /* Icon hover color */
            }
        </style>

        <div class="container login-container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="heading mb-1">
                                <h2 class="title">Update Password</h2>
                            </div>

                            <form action="{{route('customer.password.update')}}" method="post">
                                @csrf

                                <div class="password-input-container">
                                    <label for="login-password">
                                        Enter New Password
                                        <span class="required">*</span>
                                    </label>

                                    @php $customerId = Request::get('customer_id'); @endphp
                                    <input type="hidden" name="customer_id" value="{{$customerId}}">
                                    <input type="password" name="update_password" class="form-input form-wide mb-1" id="login-password"  />
                                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                                        <i class="fa fa-eye-slash" id="eye-icon"></i> <!-- Font Awesome icon -->
                                    </span>
    {{--                                <input type="password" name="new_password" class="form-input form-wide mb-1" id="new-password"  />--}}
                                    <div class="text-danger">
                                        <small> @error('error') {{$message}}@enderror</small>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-dark btn-md w-100">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End .main -->

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('login-password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text'; // Show password
                eyeIcon.classList.add('fa-eye');
                eyeIcon.classList.remove('fa-eye-slash'); // Change icon to "eye-slash"
            } else {
                passwordInput.type = 'password'; // Hide password
                eyeIcon.classList.add('fa-eye-slash');
                eyeIcon.classList.remove('fa-eye'); // Change icon to "eye"
            }
        }
        // document.getElementById('register-phone').addEventListener('input', function (e) {
        //     e.target.value = e.target.value.replace(/\D/g, '');
        //     let value = e.target.value;
        //     if (e.target.value.length > 11) {
        //         e.target.value = e.target.value.slice(0, 11);
        //     }
        // });
        // document.getElementById('login-phone').addEventListener('input', function (e) {
        //     e.target.value = e.target.value.replace(/\D/g, '');
        //     let value = e.target.value;
        //     if (e.target.value.length > 11) {
        //         e.target.value = e.target.value.slice(0, 11);
        //     }
        // });
    </script>
@endsection
