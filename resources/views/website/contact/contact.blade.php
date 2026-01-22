@extends('website.layouts.master')
@section('title','Contact')
@section('body')
<main class="main">
{{--    <nav aria-label="breadcrumb" class="breadcrumb-nav">--}}
{{--        <div class="container">--}}
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item">--}}
{{--                    <a href="demo4.html"><i class="icon-home"></i></a>--}}
{{--                </li>--}}
{{--                <li class="breadcrumb-item active" aria-current="page">--}}
{{--                    Contact Us--}}
{{--                </li>--}}
{{--            </ol>--}}
{{--        </div>--}}
{{--    </nav>--}}

{{--     <div id="map">--}}
{{--         <div class="mt-8 mb-2" >--}}
{{--             <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d20658.213960025067!2d90.39058209763336!3d23.751273387328848!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1736432614537!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>--}}
{{--         </div>--}}
{{--     </div>--}}

    <div class="container contact-us-container">
        <div class="contact-info">
            <div class="row mt-8">

                <div class="col-sm-6 col-lg-3 col-6">
                    <div class="feature-box text-center">
                        <i class="sicon-location-pin"></i>
                        <div class="feature-box-content">
                            <h3>Address</h3>
                            <h5>{{$setting->company_address}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 col-6">
                    <div class="feature-box text-center">
                        <i class="fa fa-mobile-alt"></i>
                        <div class="feature-box-content">
                            <h3>Phone Number</h3>
                            <h5>{{$setting->contact_phone}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 col-6">
                    <div class="feature-box text-center">
                        <i class="far fa-envelope"></i>
                        <div class="feature-box-content">
                            <h3>E-mail Address</h3>
                            <h5><a >{{$setting->contact_email}}</a></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-sm-6 col-md-4 count-container">
                    <div class="feature-box text-center">
                        <i class="far fa-clock"></i>
                        <div class="feature-box-content">
                            <h3>{{$setting->support_hours}}Hr</h3>
                            <h5>
                                SUPPORT AVAILABLE</h5>
                        </div>
                    </div>
                </div>
{{--                <div class="col-sm-6 col-lg-3 col-6">--}}
{{--                    <div class="feature-box text-center">--}}
{{--                        <i class="far fa-calendar-alt"></i>--}}
{{--                        <div class="feature-box-content">--}}
{{--                            <h3>Working Days/Hours</h3>--}}
{{--                            <h5>Mon - Sun / 9:00AM - 8:00PM</h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h2 class="mt-6 mb-2">Send Us a Message</h2>

                <form class="mb-0" action="{{route('contact_message.store')}}" method="post" id="contactForm">
                    @csrf
                    <div class="form-group">
                        <label class="mb-1" for="name">Your Name <span class="required">*</span></label>
                        <input type="text" name="name" class="form-control" id="name" />
                        <small class="text-danger error" id="nameError"></small>
                    </div>

                    <div class="form-group">
                        <label class="mb-1" for="email">Your E-mail <span class="required">*</span></label>
                        <input type="email" name="email" class="form-control" id="email" />
                        <small class="text-danger error" id="emailError"></small>
                    </div>

                    <div class="form-group">
                        <label class="mb-1" for="phone">Phone <span class="required">*</span></label>
                        <input type="number" name="phone" class="form-control" id="phone" />
                        <small class="text-danger error" id="phoneError"></small>
                    </div>

                    <div class="form-group">
                        <label class="mb-1" for="message">Your Message <span class="required">*</span></label>
                        <textarea cols="30" rows="1" id="message" class="form-control" name="message"></textarea>
                        <small class="text-danger error" id="messageError"></small>
                    </div>

                    <div class="form-footer mb-0">
                        <button type="submit" class="btn btn-dark font-weight-normal">Send Message</button>
                    </div>
                </form>

            </div>
            <div class="col-lg-6">
                <div class="mt-10 mb-2" >
                    {!!$setting->google_map!!}
                </div>
            </div>
        </div>

    </div>

</main>

<script>
    $(document).ready(function () {
        // Real-time validation
        $("#contactForm input, #contactForm textarea").on("input", function () {
            validateField($(this));
        });

        // On form submit
        $("#contactForm").on("submit", function (e) {
            let isValid = true;

            // Validate all fields
            $("#contactForm input, #contactForm textarea").each(function () {
                if (!validateField($(this))) {
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault(); // Prevent form submission if validation fails
            }
        });

        // Function to validate a single field
        function validateField(field) {
            const id = field.attr("id");
            const value = field.val().trim();
            let isValid = true;

            // Clear previous error message
            $("#" + id + "Error").text("");

            // Validation rules
            if (id === "name") {
                if (value === "") {
                    $("#" + id + "Error").text("Please enter your name.");
                    isValid = false;
                }
            } else if (id === "email") {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (value === "") {
                    $("#" + id + "Error").text("Please enter your email.");
                    isValid = false;
                } else if (!emailPattern.test(value)) {
                    $("#" + id + "Error").text("Please enter a valid email address.");
                    isValid = false;
                }
            } else if (id === "phone") {
                if (value === "") {
                    $("#" + id + "Error").text("Please enter your phone number.");
                    isValid = false;
                } else if (value.length < 11) {
                    $("#" + id + "Error").text("Phone number must be at least 11 digits.");
                    isValid = false;
                }
            } else if (id === "message") {
                if (value === "") {
                    $("#" + id + "Error").text("Please enter your message.");
                    isValid = false;
                }
            }

            // Add or remove error class
            if (!isValid) {
                field.addClass("is-invalid");
            } else {
                field.removeClass("is-invalid");
            }

            return isValid;
        }
    });
</script>
@endsection
