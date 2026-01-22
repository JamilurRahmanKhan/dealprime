@extends('admin.layouts.master')
@section('title')Pop Up Edit @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('popups.index')}}">Pop Up Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Pop Up Edit</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Pop Up Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Pop Up form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('popups.update',$popUps->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label">Image</label>
                            <div class="col-md-7">
                                <div class="form-group">

                                    <input type="file" class="form-control" id="imageInput" name="image">
                                    <small class="form-text text-muted">Image size should be 600x400 pixels.</small>
                                    <div class="text-danger">@error('image'){{ $message }}@enderror</div>
                                    <small id="errorMessage" class="form-text text-danger"></small>
                                    @error('image')<div  class="text-danger"><small>{{ $message }}</small></div>@enderror
                                    <div id="image-preview" ></div>
                                   </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label for="code" class="col-md-3 col-form-label">Image Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$popUps->image_link}}" value="{{old('image_link')}}" name="image_link" id="image_link" placeholder="Set Url"/>
                                <div class="text-danger">@error('image_link'){{$message}} @enderror</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1"  {{$popUps->status==1?'checked':''}}  name="status"  id="status1">
                                    <label class="form-check-label" for="status1">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="2"  {{$popUps->status==2?'checked':''}}  name="status" id="status2">
                                    <label class="form-check-label" for="status2">
                                        Unpublished
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Update PopUp</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>

<script>
    document.getElementById('image').addEventListener('change', function (event) {
        const errorMessage = document.getElementById('errorMessage');
        const image_preview = document.getElementById('image-preview');
        const file = event.target.files[0];

        // Clear previous error message
        errorMessage.textContent = '';

        if (file) {
            const maxSizeInBytes = 2 * 1024 * 1024; // 2 MB limit (example size)
            const requiredWidth = 600; // Required width
            const requiredHeight = 400; // Required height

            // Check file size
            if (file.size > maxSizeInBytes) {
                errorMessage.textContent = 'File size must not exceed 2 MB.';
                event.target.value = ''; // Clear the input
                return;
            }

            // Check file type
            const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                errorMessage.textContent = 'Only image files are allowed.';
                event.target.value = ''; // Clear the input
                return;
            }

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
</script>

@endsection
