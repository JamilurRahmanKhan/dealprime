@extends('admin.layouts.master')
@section('title')Settings Create @endsection
@section('body')
<style>
   .image-preview {
    height: 70px;
    width: 70px;
    border: 1px solid rgba(219, 200, 200, 0.804);
}
.setting_img{
    height: 70px;
    width: 70px;
}
</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('settings.index')}}">Settings Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Settings Edit</li>
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
                    <h4 class="header-title">Edit Settings form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>

                    <form class="form-horizontal" action="{{ route('settings.update',$setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <!--company name-->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Company Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="company_name" id="name" value="{{old('company_name',$setting->company_name)}}" placeholder="Company  Name"/>
                                <div class="text-danger">@error('company_name'){{$message}} @enderror</div>
                            </div>
                        </div>

                        <!-- Contact Phone-->
                        <div class="row mb-3">
                            <label for="contact_phone" class="col-md-3 col-form-label">Contact Phone</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="contact_phone" id="contact_phone" value="{{old('contact_phone',$setting->contact_phone)}}" placeholder="Contact Phone"/>
                                <div class="text-danger">@error('contact_phone'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Support Phone-->
                        <div class="row mb-3">
                            <label for="support_phone" class="col-md-3 col-form-label">Support Phone</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="support_phone" id="support_phone" value="{{old('support_phone',$setting->support_phone)}}" placeholder="Support Phone"/>
                                <div class="text-danger">@error('support_phone'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Contact Email-->
                        <div class="row mb-3">
                            <label for="contact_email" class="col-md-3 col-form-label">Contact Email</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="contact_email" id="contact_email" value="{{old('contact_email',$setting->contact_email)}}" placeholder="Contact Email"/>
                                <div class="text-danger">@error('contact_email'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Support Email-->
                        <div class="row mb-3">
                            <label for="support_email" class="col-md-3 col-form-label">Support Email</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="support_email" id="support_email" value="{{old('support_email',$setting->support_email)}}" placeholder="Support Email"/>
                                <div class="text-danger">@error('support_email'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Office Hour-->
                        <div class="row mb-3">
                            <label for="support_hours" class="col-md-3 col-form-label">Support Hour</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="support_hours" id="support_hours" value="{{old('support_hours',$setting->support_hours)}}" placeholder="Support Hour"/>
                                <div class="text-danger">@error('support_hours'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Facebook Link-->
                        <div class="row mb-3">
                            <label for="facebook" class="col-md-3 col-form-label">Facebook Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="facebook" id="facebook" value="{{old('facebook',$setting->facebook)}}" placeholder="Facebook Link"/>
                                <div class="text-danger">@error('facebook'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Twitter Link-->
                        <div class="row mb-3">
                            <label for="twitter" class="col-md-3 col-form-label">Twitter Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="twitter" id="twitter" value="{{old('twitter',$setting->twitter)}}" placeholder="Twitter Link"/>
                                <div class="text-danger">@error('twitter'){{$message}} @enderror</div>
                            </div>
                        </div>

                        <!-- Instagram Link-->
                        <div class="row mb-3">
                            <label for="instagram" class="col-md-3 col-form-label">Instagram Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control"  name="instagram" id="instagram" value="{{old('instagram',$setting->instagram)}}" placeholder="Instagram Link"/>
                                <div class="text-danger">@error('instagram'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Google map-->
                        <div class="row mb-3">
                            <label for="google_map" class="col-md-3 col-form-label">Google map</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="google_map" rows="2" cols="2" placeholder="Google map" name="google_map">{!!$setting->google_map!!}</textarea>
                                <div class="text-danger">@error('google_map'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Company Address-->
                        <div class="row mb-3">
                            <label for="company_address" class="col-md-3 col-form-label">Company Address</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="company_address" rows="2" cols="2" placeholder="Company Address" name="company_address">{!!$setting->company_address!!}</textarea>
                                <div class="text-danger">@error('company_address'){{$message}} @enderror</div>
                            </div>
                        </div>

                            <!-- Company Address-->
                            <div class="row mb-3">
                                <label for="trade_no" class="col-md-3 col-form-label">Trade No</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="trade_no"  placeholder="trade no" name="trade_no" value="{!!$setting->trade_no!!}">
                                    <div class="text-danger">@error('trade_no'){{$message}} @enderror</div>
                                </div>
                            </div>
                            <!-- Company Address-->
                            <div class="row mb-3">
                                <label for="tin_no" class="col-md-3 col-form-label">Tin No</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="tin_no"  placeholder="tin no" name="tin_no" value="{!!$setting->tin_no!!}">
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
                                        <div class="image-preview" id="logoPngPreview">
                                            <img class="setting_img" src="{{asset($setting->logo_png)}}"></div>
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
                                        <div class="image-preview" id="logoFaviconPreview">
                                            <img class="setting_img" src="{{asset($setting->favicon)}}">
                                        </div>
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
                                        <div class="image-preview" id="paymentMethodImagePreview">
                                            <img class="setting_img" src="{{asset($setting->payment_method_image)}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-9 mt-2">
                                <button type="submit" class="btn btn-info">Update setting</button>
                            </div>
                        </div>
                        </div>
                    </form>

                    {{-- <form class="form-horizontal" action="{{ route('settings.update',$setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <!--company name-->
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Company Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->company_name}}" name="company_name" id="name" value="{{old('company_name')}}" placeholder="Company  Name"/>
                                <div class="text-danger">@error('companey_name'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!--Company Slogan-->
                        <div class="row mb-3">
                            <label for="slogan" class="col-md-3 col-form-label">Company Slogan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->slogan}}" name="slogan" id="slogan" value="{{old('slogan')}}" placeholder="Company Sologan"/>
                                <div class="text-danger">@error('slogan'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Company Title-->
                        <div class="row mb-3">
                            <label for="title" class="col-md-3 col-form-label">Company Title</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="title" value="{{$setting->title}}" id="title" value="{{old('title')}}" placeholder="Title"/>
                                <div class="text-danger">@error('title'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Contact Phone-->
                        <div class="row mb-3">
                            <label for="contact_phone" class="col-md-3 col-form-label">Contact Phone</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->contact_phone}}" name="contact_phone" id="contact_phone" value="{{old('contact_phone')}}" placeholder="Contact Phone"/>
                                <div class="text-danger">@error('contact_phone'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Support Phone-->
                        <div class="row mb-3">
                            <label for="support_phone" class="col-md-3 col-form-label">Support Phone</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->support_phone}}" name="support_phone" id="support_phone" value="{{old('support_phone')}}" placeholder="Support Phone"/>
                                <div class="text-danger">@error('support_phone'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Contact Email-->
                        <div class="row mb-3">
                            <label for="contact_email" class="col-md-3 col-form-label">Contact Email</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->contact_email}}" name="contact_email" id="contact_email" value="{{old('contact_email')}}" placeholder="Contact Email"/>
                                <div class="text-danger">@error('contact_email'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Support Email-->
                        <div class="row mb-3">
                            <label for="support_email" class="col-md-3 col-form-label">Support Email</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->support_email}}" name="support_email" id="support_email" value="{{old('support_email')}}" placeholder="Support Email"/>
                                <div class="text-danger">@error('support_email'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Office Hour-->
                        <div class="row mb-3">
                            <label for="office_hour" class="col-md-3 col-form-label">Office Hour</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->office_hour}}" name="office_hour" id="office_hour" value="{{old('office_hour')}}" placeholder="Office Hour"/>
                                <div class="text-danger">@error('office_hour'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Facebook Link-->
                        <div class="row mb-3">
                            <label for="facebook_link" class="col-md-3 col-form-label">Facebook Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->facebook_link}}" name="facebook_link" id="facebook_link" value="{{old('facebook_link')}}" placeholder="Facebook Link"/>
                                <div class="text-danger">@error('facebook_link'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Twitter Link-->
                        <div class="row mb-3">
                            <label for="twitter_link" class="col-md-3 col-form-label">Twitter Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->twitter_link}}" name="twitter_link" id="twitter_link" value="{{old('twitter_link')}}" placeholder="Twitter Link"/>
                                <div class="text-danger">@error('twitter_link'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- linkedin link	 -->
                        <div class="row mb-3">
                            <label for="linkedin_link" class="col-md-3 col-form-label">Linkedin Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->linkedin_link}}" name="linkedin_link" id="linkedin_link" value="{{old('linkedin_link')}}" placeholder="Linkedin Link"/>
                                <div class="text-danger">@error('linkedin_link'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- youtube  Link-->
                        <div class="row mb-3">
                            <label for="youtube_link" class="col-md-3 col-form-label">Youtube Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->youtube_link}}" name="youtube_link" id="youtube_link" value="{{old('youtube_link')}}" placeholder="Youtube Link"/>
                                <div class="text-danger">@error('youtube_link'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Instagram Link-->
                        <div class="row mb-3">
                            <label for="instagram_link" class="col-md-3 col-form-label">Instagram Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->instagram_link}}" name="instagram_link" id="instagram_link" value="{{old('instagram_link')}}" placeholder="Instagram Link"/>
                                <div class="text-danger">@error('instagram_link'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Google Map Api Link-->
                        <div class="row mb-3">
                            <label for="google_map_api_link" class="col-md-3 col-form-label">Google Map Api Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->google_map_api_link}}" name="google_map_api_link" id="google_map_api_link" value="{{old('google_map_api_link')}}" placeholder="Google Map Api Link"/>
                                <div class="text-danger">@error('google_map_api_link'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- android_app_url-->
                        <div class="row mb-3">
                            <label for="android_app_url" class="col-md-3 col-form-label">Androied App Url Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->android_app_url}}" name="android_app_url" id="android_app_url" value="{{old('android_app_url')}}" placeholder="Androied App Url Link"/>
                                <div class="text-danger">@error('android_app_url'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Ios App Url Link-->
                        <div class="row mb-3">
                            <label for="ios_app_url" class="col-md-3 col-form-label">Ios App Url Link</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$setting->ios_app_url}}" name="ios_app_url" id="ios_app_url" value="{{old('ios_app_url')}}" placeholder="Ios App Url Link"/>
                                <div class="text-danger">@error('ios_app_url'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Company Address-->
                        <div class="row mb-3">
                            <label for="company_address" class="col-md-3 col-form-label">Company Address</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="company_address" rows="2" cols="2" placeholder="Company Address" name="company_address">{!!$setting->company_address!!}</textarea>
                                <div class="text-danger">@error('company_address'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <!-- Android App Image -->
                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label">Android App Image</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="file" class="form-control" name="android_app_image" id="androidAppImage" accept="image/*">
                                        <div class="text-danger">@error('android_app_image'){{ $message }}@enderror</div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="image-preview"  id="androidAppImagePreview"> <img class="setting_img" src="{{asset($setting->android_app_image)}}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- iOS App Image -->
                        <div class="row mb-3">
                            <label for="iosAppImage" class="col-md-3 col-form-label">iOS App Image</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="file" class="form-control" name="ios_app_image" id="iosAppImage" accept="image/*">
                                        <div class="text-danger">@error('ios_app_image'){{ $message }}@enderror</div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="image-preview" id="iosAppImagePreview"><img class="setting_img" src="{{asset($setting->ios_app_image)}}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Logo JPG -->
                        <div class="row mb-3">
                            <label for="logoJpg" class="col-md-3 col-form-label">Logo JPG</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="file" class="form-control" name="logo_jpg" id="logoJpg" accept="image/jpeg">
                                        <div class="text-danger">@error('logo_jpg'){{ $message }}@enderror</div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="image-preview" id="logoJpgPreview"><img class="setting_img" src="{{asset($setting->logo_jpg)}}"></div>
                                    </div>
                                </div>
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
                                        <div class="image-preview" id="logoPngPreview"><img class="setting_img" src="{{asset($setting->logo_png)}}"></div>
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
                                        <div class="image-preview" id="logoFaviconPreview">
                                            <img class="setting_img" src="{{asset($setting->favicon)}}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Logo favicon -->
                        <div class="row mb-3">
                            <label for="paymentMethodImage" class="col-md-3 col-form-label">Payment Method Image</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="file" class="form-control" name="payment_method_image" id="paymentMethodImage" accept="image/*">
                                        <div class="text-danger">@error('payment_method_image'){{ $message }}@enderror</div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="image-preview" id="paymentMethodImagePreview"><img class="setting_img" src="{{asset($setting->payment_method_image)}}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-9 mt-2">
                                <button type="submit" class="btn btn-info">Update setting</button>
                            </div>
                        </div>
                        </div>
                    </form> --}}
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
