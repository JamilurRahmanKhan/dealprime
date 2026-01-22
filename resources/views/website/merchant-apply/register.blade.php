@extends('website.layouts.master')
@section('title','Partner Register')
@section('body')
<style>
    .error-message {
        font-size: 11px;
        color: red;
        visibility: hidden; /* Reserve space for the error message */
        height: 1.5rem; /* Define a fixed height for the error message */
    }

    .error-message.active {
        visibility: visible; /* Show the error message when active */
    }
</style>

<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            Partner Register
                        </li>
                    </ol>
                </div>
            </nav>

            <h1> Become a Partner </h1>
        </div>
    </div>

    <div class="container login-container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 c-d-none">
                <div class="card">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <img src="https://www.dindinn.com/images/Welisten-Taking-Orders-Digitally-1to1-copy.gif" style="height: 584px; width:100%;" alt="Tracking GIF">
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card py-2">
                    <div class="card-body">
                        <h4 >Partner Information</h4>
                        <span > First please read our teams and condition for become a Partner.</span>
                        <form  action="{{route('merchant.store')}}" method="post" id="merchantForm" class="mb-0 mt-3">
                            @csrf
                            <div>
                                <label for="name" class="form-label">Partner Holder Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}" id="name" placeholder="Enter your name">
                                <span class="text-danger">@error('name'){{$message}} @enderror</span>
                                <div class="error-message" id="nameError">Name is required.</div>
                            </div>
                            <div>
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{old('email')}}" id="email" placeholder="Enter your email">
                                <span class="text-danger">@error('email'){{$message}} @enderror</span>
                                <div class="error-message" id="emailError">Valid email is required.</div>
                            </div>
                            <div>
                                <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" value="{{old('phone')}}" id="phone" placeholder="Phone number">
                                <span class="text-danger">@error('phone'){{$message}} @enderror</span>
                                <div class="error-message" id="phoneError">Phone number must be numeric and 11 digits.</div>
                            </div>
                            <div>
                                <label for="shopName" class="form-label">Shop Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="shop_name" value="{{old('shop_name')}}" id="shopName" placeholder="Enter your shop name">
                                <span class="text-danger">@error('shop_name'){{$message}} @enderror</span>
                                <div class="error-message" id="shopNameError">Shop name is required.</div>
                            </div>
                            <div class="text-center ">
                                <input type="checkbox" id="terms">
                                <label for="terms" style="text-decoration: none"> <a href="{{route('terms.condition')}}">Terms & condition</a></label>
                                <div class="error-message" id="termsError">You must agree to the terms and conditions.</div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function () {
        // Validate name
        $('#name').on('input', function () {
            const isValid = $(this).val().trim() !== '';
            toggleError('#nameError', isValid);
        });

        // Validate email
        $('#email').on('input', function () {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const isValid = emailPattern.test($(this).val().trim());
            toggleError('#emailError', isValid);
        });

        // Validate phone
        $('#phone').on('input', function () {
            const phonePattern = /^[0-9]{11}$/;
            const isValid = phonePattern.test($(this).val().trim());
            toggleError('#phoneError', isValid);
        });

        // Validate shop name
        $('#shopName').on('input', function () {
            const isValid = $(this).val().trim() !== '';
            toggleError('#shopNameError', isValid);
        });

        // Validate terms and conditions
        $('#terms').on('change', function () {
            const isValid = $(this).is(':checked');
            toggleError('#termsError', isValid);
        });

        // Final form validation on submit
        $('#merchantForm').on('submit', function (e) {
            let isValid = true;

            if ($('#name').val().trim() === '') {
                toggleError('#nameError', false);
                isValid = false;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test($('#email').val().trim())) {
                toggleError('#emailError', false);
                isValid = false;
            }

            const phonePattern = /^[0-9]{11}$/;
            if (!phonePattern.test($('#phone').val().trim())) {
                toggleError('#phoneError', false);
                isValid = false;
            }

            if ($('#shopName').val().trim() === '') {
                toggleError('#shopNameError', false);
                isValid = false;
            }

            if (!$('#terms').is(':checked')) {
                toggleError('#termsError', false);
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault(); // Prevent form submission if validation fails
            }
        });

        // Toggle error visibility
        function toggleError(selector, isValid) {
            if (isValid) {
                $(selector).removeClass('active');
            } else {
                $(selector).addClass('active');
            }
        }
    });
     document.getElementById('phone').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, '');
            let value = e.target.value;
            if (e.target.value.length > 11) {
                e.target.value = e.target.value.slice(0, 11);
            }
        });
</script>

@endsection
