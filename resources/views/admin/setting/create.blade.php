@extends('admin.layouts.master')
@section('title')Settings Create @endsection
@section('body')
<style>
   .image-preview {
    height: 70px;
    width: 70px;
    border: 1px solid rgba(219, 200, 200, 0.804);
}
</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Settings Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Settings Create</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Settings Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Add Settings form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--company name-->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Company Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="company_name" id="name" value="{{old('company_name')}}" placeholder="Company  Name"/>
                                <div class="text-danger">@error('company_name'){{$message}} @enderror</div>
                            </div>
                        </div>

                        <!-- Contact Phone-->
                        <div class="row mb-3">
                            <label for="contact_phone" class="col-md-3 col-form-label">Contact Phone</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="contact_phone" id="contact_phone" value="{{old('contact_phone')}}" placeholder="Contact Phone"/>
                                <div class="text-danger">@error('contact_phone'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Support Phone-->
                        <div class="row mb-3">
                            <label for="support_phone" class="col-md-3 col-form-label">Support Phone</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="support_phone" id="support_phone" value="{{old('support_phone')}}" placeholder="Support Phone"/>
                                <div class="text-danger">@error('support_phone'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Contact Email-->
                        <div class="row mb-3">
                            <label for="contact_email" class="col-md-3 col-form-label">Contact Email</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="contact_email" id="contact_email" value="{{old('contact_email')}}" placeholder="Contact Email"/>
                                <div class="text-danger">@error('contact_email'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Support Email-->
                        <div class="row mb-3">
                            <label for="support_email" class="col-md-3 col-form-label">Support Email</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="support_email" id="support_email" value="{{old('support_email')}}" placeholder="Support Email"/>
                                <div class="text-danger">@error('support_email'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Office Hour-->
                        <div class="row mb-3">
                            <label for="support_hours" class="col-md-3 col-form-label">Support Hour</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="support_hours" id="support_hours" value="{{old('support_hours')}}" placeholder="Support Hour"/>
                                <div class="text-danger">@error('support_hours'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Facebook Link-->
                        <div class="row mb-3">
                            <label for="facebook" class="col-md-3 col-form-label">Facebook Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="facebook" id="facebook" value="{{old('facebook')}}" placeholder="Facebook Link"/>
                                <div class="text-danger">@error('facebook'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Twitter Link-->
                        <div class="row mb-3">
                            <label for="twitter" class="col-md-3 col-form-label">Twitter Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="twitter" id="twitter" value="{{old('twitter')}}" placeholder="Twitter Link"/>
                                <div class="text-danger">@error('twitter'){{$message}} @enderror</div>
                            </div>
                        </div>

                        <!-- Instagram Link-->
                        <div class="row mb-3">
                            <label for="instagram" class="col-md-3 col-form-label">Instagram Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="instagram" id="instagram" value="{{old('instagram')}}" placeholder="Instagram Link"/>
                                <div class="text-danger">@error('instagram'){{$message}} @enderror</div>
                            </div>
                        </div>
                       <!-- Google map-->
                       <div class="row mb-3">
                        <label for="google_map" class="col-md-3 col-form-label">Google map</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="google_map" rows="2" cols="2" placeholder="Google map" name="google_map"></textarea>
                            <div class="text-danger">@error('google_map'){{$message}} @enderror</div>
                        </div>
                    </div>

                        <!-- Company Address-->
                        <div class="row mb-3">
                            <label for="company_address" class="col-md-3 col-form-label">Company Address</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="company_address" rows="2" cols="2" placeholder="Company Address" name="company_address"></textarea>
                                <div class="text-danger">@error('company_address'){{$message}} @enderror</div>
                            </div>
                        </div>
 <!-- Company Address-->
                        <div class="row mb-3">
                            <label for="trade_no" class="col-md-3 col-form-label">Trade No</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="trade_no"  placeholder="trade no" name="trade_no">
                                <div class="text-danger">@error('trade_no'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Company Address-->
                        <div class="row mb-3">
                            <label for="tin_no" class="col-md-3 col-form-label">Tin No</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="tin_no"  placeholder="trade no" name="tin_no">
                                <div class="text-danger">@error('tin_no'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Logo PNG -->
                        <div class="row mb-3">
                            <label for="logoPng" class="col-md-3 col-form-label">Logo Png</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="file" name="logo_png" class="form-control" id="logoPng" accept="image/png">
                                        <div class="text-danger">@error('logo_png'){{ $message }}@enderror</div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="image-preview" id="logoPngPreview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Logo favicon -->
                        <div class="row mb-3">
                            <label for="logoFavicon" class="col-md-3 col-form-label">Favion</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="file" class="form-control" name="favicon" id="logoFavicon" accept="image/*">
                                        <div class="text-danger">@error('favicon'){{ $message }}@enderror</div>
                                    </div>
                                    <div class="col-md-2 ">
                                        <div class="image-preview" id="logoFaviconPreview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Payment method  -->
                        <div class="row mb-3">
                            <label for="paymentMethodImage" class="col-md-3 col-form-label">Payment Method Image</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="file" class="form-control" name="payment_method_image" id="paymentMethodImage" accept="image/*">
                                        <div class="text-danger">@error('payment_method_image'){{ $message }}@enderror</div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="image-preview" id="paymentMethodImagePreview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-9 mt-2">
                                <button type="submit" class="btn btn-info">Save setting</button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>

                <script>
                    $(document).ready(function() {
                        function readURL(input, previewId) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    $(previewId).html('<img style="width:70px; height:70px;"  src="'+e.target.result+'" alt="Image Preview">');
                                    $(previewId + ' img').show();
                                }
                                reader.readAsDataURL(input.files[0]);
                            } else {
                                $(previewId).html('Preview');
                            }
                        }

                        $("#androidAppImage").change(function() {
                            readURL(this, "#androidAppImagePreview");
                        });
                        $("#iosAppImage").change(function() {
                            readURL(this, "#iosAppImagePreview");
                        });
                        $("#logoJpg").change(function() {
                            readURL(this, "#logoJpgPreview");
                        });
                        $("#logoPng").change(function() {
                            readURL(this, "#logoPngPreview");
                        });
                        $("#logoFavicon").change(function() {
                            readURL(this, "#logoFaviconPreview");
                        });
                        $("#paymentMethodImage").change(function() {
                            readURL(this, "#paymentMethodImagePreview");
                        });
                    });
                </script>
@endsection
