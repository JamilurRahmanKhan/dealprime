@extends('admin.layouts.master')
@section('title')Banner Edit @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('banner.index')}}">Banner Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Banner Edit</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Banner Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Banner form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('banner.update',$banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label">Banner Image</label>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="imageInput" value="{{ asset($banner->image) }}" name="image"  accept="image/*" />
                                    <div class="text-danger">@error('image'){{$message}} @enderror</div>
                                    <small class="form-text text-muted">Image size should be 1920x300 pixels.</small><br>
                                    <div class="text-danger" id="imageError" style="display:none;"></div>
                                    <small id="errorMessage" class="form-text text-danger"></small>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <img id="imagePreview" src="{{ asset($banner->image) }}" alt="Your Image"
                                        class="img-fluid" style="display:{{ $banner->image ? 'block' : 'none' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="BannerTitle" class="col-md-3 col-form-label">Image link</label>
                            <div class="col-md-9">
                                <input type="text" name="image_url" value="{{$banner->image_url}}" placeholder="Image url" class="form-control">
                                <div class="text-danger">@error('image_url'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="BannerSubTitle" class="col-md-3 col-form-label">Banner position</label>
                            <div class="col-md-9">
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$banner->banner_position==1?'checked':'disabled'}}  name="banner_position" type="checkbox" id="1" value="1">
                                    <label class="form-check-label" for="1">1</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$banner->banner_position==2?'checked':'disabled'}} name="banner_position" type="checkbox" id="2" value="2">
                                    <label class="form-check-label" for="2">2</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$banner->banner_position==3?'checked':'disabled'}} name="banner_position" type="checkbox" id="3" value="3" >
                                    <label class="form-check-label" for="3">3 </label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" {{$banner->banner_position==4?'checked':'disabled'}} name="banner_position" type="checkbox" id="4" value="4" >
                                    <label class="form-check-label" for="4">4 </label>
                                  </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" {{$banner->status==1?'checked':''}} name="status"  id="status1">
                                    <label class="form-check-label" for="status1">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0"  {{$banner->status==0?'checked':''}}   name="status" id="status2">
                                    <label class="form-check-label" for="status2">
                                        Unpublished
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Update Banner</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>
    {{-- <script>
        $(document).ready(function () {
            // Fetch the banner positions via AJAX
            $.ajax({
                url: "{{ route('banner.positions') }}",
                method: "GET",
                success: function (positions) {
                    // Iterate over the positions and set them to disabled and checked
                    positions.forEach(function (position) {
                        $(`input[name="banner_position"][value="${position}"]`)
                            .prop('disabled', true)
                            .prop('checked', true);
                    });
                },
                error: function (xhr) {
                    console.error("Error fetching banner positions:", xhr.responseText);
                }
            });

            // Handle change event for banner position inputs
            $('input[name="banner_position"]').on('change', function () {
                if (!$(this).is(':checked')) {
                    $(this).prop('disabled', false);
                }
            });
        });
    </script> --}}
<script>
    document.getElementById('imageInput').addEventListener('change', function (event) {

        const errorMessage = document.getElementById('errorMessage');
        const image_preview = document.getElementById('image-preview');
        const file = event.target.files[0];

        // Clear previous error message
        errorMessage.textContent = '';

        if (file) {
            const maxSizeInBytes = 2 * 1024 * 1024; // 2 MB limit (example size)
            const requiredWidth = 1920; // Required width
            const requiredHeight = 300; // Required height

            // Check file size
            if (file.size > maxSizeInBytes) {
                errorMessage.textContent = 'File size must not exceed 2 MB.';
                event.target.value = ''; // Clear the input
                return;
            }

            // Check file type
            // const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            // if (!validTypes.includes(file.type)) {
            //     errorMessage.textContent = 'Only image files are allowed.';
            //     event.target.value = ''; // Clear the input
            //     return;
            // }

            // Check resolution
            const img = new Image();
            img.onload = function () {
                if (this.width !== requiredWidth || this.height !== requiredHeight) {

                    errorMessage.textContent = `Image dimensions must be exactly ${requiredWidth}x${requiredHeight} pixels.`;
                    event.target.value = '';
                    image_preview.style.display = 'none'// Clear the input
                }else{
                    image_preview.style.display = 'block'
                }
            };
            img.onerror = function () {
                errorMessage.textContent = 'Invalid image file.';
                event.target.value = ''; // Clear the input
            };
            img.src = URL.createObjectURL(file);
        }
    });
    $(document).ready(function () {
        let isImageValid = true; // Assume valid unless an image is uploaded and invalid

        $('form').on('submit', function (e) {
            const file = $('#imageInput')[0].files[0];
            if (file && !isImageValid) {
                e.preventDefault(); // Prevent form submission
                $('#imageError').text('Please upload a valid image with a height of 300px.').show();
            }
        });
    });
</script>
@endsection
