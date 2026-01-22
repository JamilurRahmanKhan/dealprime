@extends('admin.layouts.master')
@section('title')User Edit  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('user.index')}}">User Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Edit User</li>
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
                    <h4 class="header-title">Edit User form</h4>
                    <p class="text-muted font-14">{{Session::get('message')}}</p>
                    <form class="form-horizontal" action="{{route('user.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label">Image</label>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="imageInput" name="profile_photo_path">
                                    <div class="text-danger">@error('profile_photo_path'){{$message}} @enderror</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <img id="imagePreview" src="{{ asset($user->profile_photo_path) }}" alt="Your Image" class="img-fluid" style="display: {{ $user->profile_photo_path ? 'block' : 'none' }};"/>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-3 col-form-label">User Name</label>
                            <div class="col-9">
                                <input type="text" class="form-control @error('name') is-invalid @enderror " name="name" id="nameInput" value="{{$user->name}}" id="inputEmail3" placeholder="User Name"/>
                                <span class="invalid-feedback" id="nameError"></span>
                                @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail31" class="col-3 col-form-label">User Email</label>
                            <div class="col-9">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" name="email" id="inputEmail31" placeholder="User Email"/>
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
                                    value="{{$user->phone}}"
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
                                     value="{{$user->shop_name}}"
                                    placeholder="Shop Name" />
                                <span class="invalid-feedback" id="shopError"></span>
                                @error('shop_name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail32" class="col-3 col-form-label">Password</label>
                            <div class="col-9">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"  name="password" id="inputEmail32" placeholder="Password"/>
                                @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-3 col-form-label">Confirm Password</label>
                            <div class="col-9">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror "  name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"/>
                                @error('password_confirmation')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail33" class="col-3 col-form-label">Select Role</label>
                            <div class="col-9">
                                <select class="form-control @error('role') is-invalid @enderror" name="role">
                                    <option value="" disabled {{ $user->role ? '' : 'selected' }}>Select Role</option>
                                    @if ($roles->count())
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" {{ $role->name == $user->role ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option disabled>Oops! Role not found!</option>
                                    @endif
                                </select>
                                @error('role')<span class="invalid-feedback">{{ $message }}</span>@enderror

                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$user->status==1?'checked':''}}  type="radio" value="1" name="status"  id="status1">
                                    <label class="form-check-label" for="status1">Published</label>
                                </div>
                                &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$user->status==0 ?'checked':''}}  type="radio" value="0" name="status" id="status2">
                                    <label class="form-check-label" for="status2">Unpublished</label>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Update  User</button>
                            </div>
                        </div>
                    </form>

                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>


    <script>
        $(document).ready(function() {
            // Name validation
            $('#nameInput').on('input', function() {
                const name = $(this).val();
                if (name === "") {
                    $(this).addClass('is-invalid');
                    $('#nameError').text("User Name is required.");
                } else if (name.length < 3) {
                    $(this).addClass('is-invalid');
                    $('#nameError').text("User Name must be at least 3 characters.");
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $('#nameError').text("");
                }
            });

            // Email validation
            $('#emailInput').on('input', function() {
                const email = $(this).val();
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (email === "") {
                    $(this).addClass('is-invalid');
                    $('#emailError').text("Email is required.");
                } else if (!emailPattern.test(email)) {
                    $(this).addClass('is-invalid');
                    $('#emailError').text("Enter a valid email address.");
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $('#emailError').text("");
                }
            });

            // Password validation
            $('#passwordInput').on('input', function() {
                const password = $(this).val();
                if (password === "") {
                    $(this).addClass('is-invalid');
                    $('#passwordError').text("Password is required.");
                } else if (password.length < 6) {
                    $(this).addClass('is-invalid');
                    $('#passwordError').text("Password must be at least 6 characters.");
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $('#passwordError').text("");
                }
            });

            // Confirm password validation
            $('#passwordConfirmationInput').on('input', function() {
                const password = $('#passwordInput').val();
                const confirmPassword = $(this).val();
                if (confirmPassword === "") {
                    $(this).addClass('is-invalid');
                    $('#passwordConfirmationError').text("Please confirm your password.");
                } else if (confirmPassword !== password) {
                    $(this).addClass('is-invalid');
                    $('#passwordConfirmationError').text("Passwords do not match.");
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $('#passwordConfirmationError').text("");
                }
            });

            // Role selection validation
            $('#roleInput').on('change', function() {
                if ($(this).val() === null) {
                    $(this).addClass('is-invalid');
                    $('#roleError').text("Please select a role.");
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                    $('#roleError').text("");
                }
            });

            // Prevent form submission if there are invalid fields
            $('#userForm').on('submit', function(e) {
                if ($('.is-invalid').length > 0) {
                    e.preventDefault();
                    alert("Please fix the errors before submitting.");
                }
            });
        });
        </script>

@endsection
