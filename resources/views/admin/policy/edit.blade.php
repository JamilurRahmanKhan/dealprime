@extends('admin.layouts.master')
@section('title')Policy Edit @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('policy.index')}}">Policy Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Policy Edit</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Policy Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Policy form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('policy.update',$policy->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label">Policy Image</label>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="imageInput" name="image">
                                    <div class="text-danger">@error('image'){{$message}} @enderror</div>
                                    <div class="text-danger" id="imageError" style="display:none;"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <div class="form-group ">
                                        <img id="imagePreview" src="{{ asset($policy->image) }}" alt="Your Image"
                                            class="img-fluid" style="display:{{ $policy->image ? 'block' : 'none' }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="policyTitle" class="col-md-3 col-form-label">Policy Title</label>
                            <div class="col-md-9">
                                <textarea name="title" class="form-control" placeholder="Policy title" id="policyTitle" cols="3" rows="3">{!!$policy->title!!}</textarea>
                                <small>Title can not be extends 5 word</small>
                                <div class="text-danger">@error('title'){{$message}} @enderror</div>
                                <div class="text-danger" id="titleError" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="policySubTitle" class="col-md-3 col-form-label">Policy Sub Title</label>
                            <div class="col-md-9">
                                <textarea name="sub_title" class="form-control" placeholder="Policy sub title" id="policySubTitle" cols="3" rows="3">{!!$policy->sub_title!!}</textarea>
                                <small>Sub title can not be extends 10 word</small>
                                <div class="text-danger">@error('policy_title'){{$message}} @enderror</div>
                                <div class="text-danger" id="subTitleError" style="display:none;"></div>
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Update Policy</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>


    <script>
        $(document).ready(function() {
            // On form submit
            $("form").submit(function(e) {
                // Reset any previous error messages
                $("#titleError").text("").hide();
                $("#subTitleError").text("").hide();
                $("#imageError").text("").hide();

                var isValid = true;

                // Title validation: Cannot exceed 5 words
                var title = $("#policyTitle").val().trim();
                var titleWordCount = title.split(/\s+/).length;
                if (title === "") {
                    $("#titleError").text("Policy Title is required.").show();
                    isValid = false;  // Set isValid to false if validation fails
                } else if (titleWordCount > 5) {
                    $("#titleError").text("Policy Title cannot exceed 5 words.").show();
                    isValid = false;  // Set isValid to false if validation fails
                }

                // Subtitle validation: Cannot exceed 10 words
                var subtitle = $("#policySubTitle").val().trim();
                var subtitleWordCount = subtitle.split(/\s+/).length;
                if (subtitle === "") {
                    $("#subTitleError").text("Policy Sub Title is required.").show();
                    isValid = false;  // Set isValid to false if validation fails
                } else if (subtitleWordCount > 10) {
                    $("#subTitleError").text("Policy Sub Title cannot exceed 10 words.").show();
                    isValid = false;  // Set isValid to false if validation fails
                }

                // Image validation: If image is selected, check size
                var image = $("#imageInput")[0].files[0];
                if (image) {
                    var img = new Image();
                    img.onload = function() {
                        if (img.width > 50 || img.height > 50) {
                            $("#imageError").text("Policy image must be 50x50 px.").show();
                            $("#imagePreview").hide();  // Hide preview if image is invalid
                            isValid = false;  // Set isValid to false if validation fails
                        } else {
                            $('#imagePreview').attr('src', URL.createObjectURL(image)).show();  // Show image preview
                        }
                    };
                    img.src = URL.createObjectURL(image);
                } else {
                    $("#imageError").text("").hide();  // No error if no image selected
                    $('#imagePreview').hide();  // Hide preview if no image is selected
                }

                // If any validation fails, prevent form submission
                if (!isValid) {
                    e.preventDefault();  // Prevent form submission
                }
            });

            // Real-time image preview
            $("#imageInput").on("change", function() {
                var image = $(this)[0].files[0];
                if (image) {
                    var img = new Image();
                    img.onload = function() {
                        if (img.width > 50 || img.height > 50) {
                            $("#imageError").text("Policy image must be 50x50 px.").show();
                            $("#imagePreview").hide();
                        } else {
                            $('#imagePreview').attr('src', URL.createObjectURL(image)).show();
                        }
                    };
                    img.src = URL.createObjectURL(image);
                } else {
                    $("#imageError").text("").hide();  // Hide error if no image is selected
                    $('#imagePreview').hide();  // Hide preview if no image is selected
                }
            });
        });
        </script>


@endsection
