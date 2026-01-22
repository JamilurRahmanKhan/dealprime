@extends('website.layouts.master')
@section('title','Customer Authentication')
@section('body')
    <main class="main">
        <div class="page-header">
            <div class="container d-flex flex-column align-items-center">
                <nav aria-label="breadcrumb" class="breadcrumb-nav">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                My Account
                            </li>
                        </ol>
                    </div>
                </nav>

                <h1>My Account</h1>
            </div>
        </div>

        <div class="container login-container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="heading mb-1">
                                <h2 class="title">Login</h2>
                            </div>

                            <form action="{{route('info.check')}}" method="post">
                                @csrf
                                <label for="login-phone">
                                    Enter Registered Phone Number
                                    <span class="required">*</span>
                                </label>
                                <input type="number"  pattern="^\d{11}$" required  name="customer_phone" value="{{old('customer_phone')}}" class="form-input form-wide mb-1 customer_phone" id="login-phone"  />
                                <div class="text-danger"><small> @error('customer_phone') {{$message}}@enderror</small></div>

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
                                <div class="password-input-container">
                                    <label for="login-password">
                                        Enter  Password
                                        <span class="required">*</span>
                                    </label>
                                    <input type="password" required name="customer_password" class="form-input form-wide mb-1" id="login-password"  />
                                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                                    <i class="fa fa-eye-slash" id="eye-icon"></i> <!-- Font Awesome icon -->
                                </span>
                                    <div class="text-danger"><small> @error('customer_password') {{$message}}@enderror</small></div>
                                </div>

                                <div class="form-footer">
                                    <!--<div class="custom-control custom-checkbox mb-0">-->
                                    <!--    <input type="checkbox" name="remember_token" class="custom-control-input" id="lost-password" />-->
                                    <!--    <label class="custom-control-label mb-0" for="lost-password">Remember-->
                                    <!--        me</label>-->
                                    <!--</div>-->

                                    <a href="{{route('forgot.password')}}"
                                       class="forget-password text-dark form-footer-right">Forgot
                                        Password?</a>
                                </div>
                                <button type="submit" class="btn btn-dark btn-md w-100">
                                    LOGIN
                                </button>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <div class="heading mb-1">
                                <h2 class="title">Register</h2>
                            </div>

                            <form action="{{route('info.store')}}" method="post">
                                @csrf
                                <label for="register-phone">
                                    Phone Number
                                    <span class="required">*</span>
                                </label>
                                <!--placeholder="Enter 11-digit phone number"-->
                                <input
                                    type="number"
                                name="phone"
                                value="{{old('phone')}}"
                                class="form-input form-wide mb-1 customer_phone"
                                id="register-phone" 
                                minlength="11"
                                maxlength="11"
                                pattern="^\d{11}$"
                                required
                                oninput="validatePhoneNumber(this)"
                                />
                                <span id="phone-error" style="color: red; display: none;">Phone number must be exactly 11 digits.</span>
{{--                                <input type="number"  pattern="^\d{11}$"  name="phone" value="{{old('phone')}}" class="form-input form-wide mb-1 customer_phone" id="register-phone"  />--}}
                                <div class="text-danger"> <small>@error('phone') {{$message}}@enderror</small></div>

                                <label for="register-fullname">
                                    Full Name
                                    <span class="required">*</span>
                                </label>

                                <input type="text" name="customer_name" class="form-input form-wide mb-1" id="register-fullname"  />
                                <div class="text-danger"> <small>@error('customer_name') {{$message}}@enderror</small></div>

                                <label for="register-email">
                                    Email address
                                </label>
                                <input type="email" name="customer_email" class="form-input form-wide mb-1" id="register-email"  />
                                <div class="text-danger"><small> @error('customer_email') {{$message}}@enderror</small></div>

                                <div class="password-input-container">
                                    <label for="register-password">
                                        Password
                                        <span class="required">*</span>
                                    </label>
                                    <input type="password" name="password"  class="form-input form-wide mb-1" id="register-password" />
                                    <span class="toggle-password" onclick="regtogglePasswordVisibility()">
                                        <i class="fa fa-eye-slash" id="reg-eye-icon"></i> <!-- Font Awesome icon -->
                                    </span>
                                    <div class="text-danger"> <small>@error('password') {{$message}}@enderror</small></div>
                                    <div class="text-danger"> <small>@error('success') {{$message}}@enderror</small></div>
                                </div>

                                <div class="form-footer mb-2">
                                    <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                                        Register
                                    </button>
                                </div>
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
        function regtogglePasswordVisibility() {

            const passwordRegInput = document.getElementById('register-password');
            const eyeIcon = document.getElementById('reg-eye-icon');

            if (passwordRegInput.type === 'password') {

                passwordRegInput.type = 'text'; // Show password
                eyeIcon.classList.add('fa-eye');
                eyeIcon.classList.remove('fa-eye-slash'); // Change icon to "eye-slash"
            } else {
                passwordRegInput.type = 'password'; // Hide password
                eyeIcon.classList.add('fa-eye-slash');
                eyeIcon.classList.remove('fa-eye'); // Change icon to "eye"
            }
        }

        function validatePhoneNumber(input) {
            const phoneError = document.getElementById('phone-error');
            if (input.value.length !== 11 || !/^\d{11}$/.test(input.value)) {
                phoneError.style.display = 'inline'; // Show error message
            } else {
                phoneError.style.display = 'none'; // Hide error message
            }
        }
        document.getElementById('register-phone').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, '');
            let value = e.target.value;
            if (e.target.value.length > 11) {
                e.target.value = e.target.value.slice(0, 11);
            }
        });
        document.getElementById('login-phone').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, '');
            let value = e.target.value;
            if (e.target.value.length > 11) {
                e.target.value = e.target.value.slice(0, 11);
            }
        });
    </script>
@endsection
