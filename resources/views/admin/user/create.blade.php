@extends('admin.layouts.master')
@section('title')User Create  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">User Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Add User</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">User Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Add User form</h4>
                    <p class="text-muted font-14">{{Session::get('message')}}</p>
                 <!-- HTML Form -->
                    <form id="userForm" class="form-horizontal" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" id="userForm">
                        @csrf
                        <!-- Image Field -->
                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label">Image</label>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="imageInput" name="profile_photo_path">
                                    <div class="text-danger" id="imageError"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <img id="imagePreview" src="#" alt="Your Image" class="img-fluid"/>
                            </div>
                        </div>

                        <!-- User Name Field -->
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-3 col-form-label">User Name</label>
                            <div class="col-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror  " name="name" id="nameInput" placeholder="User Name"/>
                                <span class="invalid-feedback" id="nameError"></span>
                                @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <!-- User Email Field -->
                        <div class="row mb-3">
                            <label for="inputEmail31" class="col-3 col-form-label">User Email</label>
                            <div class="col-9">
                                <input type="email" class="form-control  @error('email') is-invalid @enderror " name="email" id="emailInput" placeholder="User Email"/>
                                <span class="invalid-feedback" id="emailError"></span>
                                @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <!-- Phone Field -->
                        <div class="row mb-3">
                            <label for="phoneInput" class="col-3 col-form-label">Phone</label>
                            <div class="col-9">
                                <input type="text"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    name="phone"
                                    id="phoneInput"
                                    placeholder="Phone Number" />
                                <span class="invalid-feedback" id="phoneError"></span>
                                @error('phone')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <!-- shop name Field -->
                        <div class="row mb-3">
                            <label for="phoneInput" class="col-3 col-form-label">Shop Name</label>
                            <div class="col-9">
                                <input type="text"
                                    class="form-control @error('shop_name') is-invalid @enderror"
                                    name="shop_name"
                                    id="shopInput"
                                    placeholder="Shop Name" />
                                <span class="invalid-feedback" id="shopError"></span>
                                @error('shop_name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="row mb-3">
                            <label for="inputEmail32" class="col-3 col-form-label">Password</label>
                            <div class="col-9">
                                <input type="password" class="form-control @error('password') is-invalid @enderror  " name="password" id="passwordInput" placeholder="Password"/>
                                <span class="invalid-feedback" id="passwordError"></span>
                                @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-3 col-form-label">Confirm Password</label>
                            <div class="col-9">
                                <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror " name="password_confirmation" id="passwordConfirmationInput" placeholder="Confirm Password"/>
                                <span class="invalid-feedback" id="passwordConfirmationError"></span>
                                @error('password_confirmation')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <!-- Role Selection Field -->
                        <div class="row mb-3">
                            <label for="inputEmail33" class="col-3 col-form-label">Select Role</label>
                            <div class="col-9">
                                <select class="form-control @error('role') is-invalid @enderror " name="role" id="roleInput">
                                    <option disabled selected>Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" id="roleError"></span>
                                @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <!-- Publication Status Field -->
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" name="status" checked id="status1">
                                    <label class="form-check-label" for="status1">Published</label>
                                </div>
                                &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0" name="status" id="status2">
                                    <label class="form-check-label" for="status2">Unpublished</label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Create New User</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>




    <script>
       $(document).ready(function() {
    function validateField(input, condition, errorMessage, errorField) {
        if (condition) {
            input.addClass('is-invalid').removeClass('is-valid');
            errorField.text(errorMessage);
            return false; // Indicate validation failure
        } else {
            input.removeClass('is-invalid').addClass('is-valid');
            errorField.text("");
            return true; // Indicate validation success
        }
    }

    function validateForm() {
        let isValid = true;

        // Name validation
        const name = $('#nameInput').val();
        isValid &= validateField(
            $('#nameInput'),
            name === "" || name.length < 3,
            name === "" ? "User Name is required." : "User Name must be at least 3 characters.",
            $('#nameError')
        );


        // Email validation
        const email = $('#emailInput').val();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        isValid &= validateField(
            $('#emailInput'),
            email === "" || !emailPattern.test(email),
            email === "" ? "Email is required." : "Enter a valid email address.",
            $('#emailError')
        );

        // Phone validation
        const phone = $('#phoneInput').val();
        const phonePattern = /^[0-9]{11}$/;
        isValid &= validateField(
            $('#phoneInput'),
            phone === "" || !phone.match(phonePattern),
            phone === "" ? "Phone number is required." : "Enter a valid 11-digit phone number.",
            $('#phoneError')
        );

         // shop name validation
        //  const shopName = $('#shopInput').val();
        // isValid &= validateField(
        //     $('#shopInput'),
        //     shopName === "" || shopName.length < 3,
        //     shopName === "" ? "Shop Name is required." : "Shop name must be at least 3 characters.",
        //     $('#shopError')
        // );

        // Password validation
        const password = $('#passwordInput').val();
        isValid &= validateField(
            $('#passwordInput'),
            password === "" || password.length < 6,
            password === "" ? "Password is required." : "Password must be at least 6 characters.",
            $('#passwordError')
        );

        // Confirm password validation
        const confirmPassword = $('#passwordConfirmationInput').val();
        isValid &= validateField(
            $('#passwordConfirmationInput'),
            confirmPassword === "" || confirmPassword !== password,
            confirmPassword === "" ? "Please confirm your password." : "Passwords do not match.",
            $('#passwordConfirmationError')
        );

        // Role selection validation
        isValid &= validateField(
            $('#roleInput'),
            $('#roleInput').val() === null,
            "Please select a role.",
            $('#roleError')
        );

        // Image file validation
        const imageFile = $('#imageInput')[0].files[0];
        isValid &= validateField(
            $('#imageInput'),
            !imageFile,
            "Please upload an image.",
            $('#imageError')
        );

        return isValid;
    }

    // On form submit
    $('#userForm').on('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault(); // Prevent form submission if validation fails
        }
    });

    // Image file preview
    $('#imageInput').on('change', function() {
        const file = this.files[0];
        const errorField = $('#imageError');
        const preview = $('#imagePreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.attr('src', e.target.result).removeClass('d-none');
                $('#imageInput').removeClass('is-invalid').addClass('is-valid');
                errorField.text("");
            };
            reader.readAsDataURL(file);
        } else {
            preview.attr('src', '#').addClass('d-none');
            $('#imageInput').addClass('is-invalid');
            errorField.text("Please upload an image.");
        }
    });
});

        </script>

@endsection
