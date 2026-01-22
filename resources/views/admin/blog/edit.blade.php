@extends('admin.layouts.master')
@section('title')Blog Edit @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('blogs.index')}}">Blog Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Blog Edit</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Blog Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Blog form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{route('blogs.update',$blog->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label for="blog_category_id" class="col-md-3 col-form-label">Blog Category Name</label>
                            <div class="col-md-9">
                                <select class="form-control" id="blog_category_id" name="blog_category_id" >
                                    <option selected disabled>---Select Blog Category Name---</option>
                                    @foreach ($blogCategories as $blogCategory )
                                    <option value="{{$blogCategory->id}}" {{$blogCategory->id==$blog->blog_category_id?'selected':''}} >{{$blogCategory->name}} </option>
                                    @endforeach
                                </select>
                            <div class="text-danger">@error('blog_category_id'){{$message}} @enderror</div>
                            </div>
                        </div>
                         <!--Tag -->
                         <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Blog Tag Name</label>
                            <div class="col-md-9">
                                <select class="tag js-states form-control px-1" name="blog_tag_id[]"
                                    multiple="multiple">
                                    @foreach ($blogTags as $singleTag)
                                    <option value="{{ $singleTag->id }}"
                                        @foreach ($blog->postTag as $postTag)
                                            @if ($postTag->blog_tag_id == $singleTag->id)
                                                selected
                                            @endif
                                        @endforeach>
                                        {{ $singleTag->name }}
                                    </option>
                                @endforeach

                                </select>
                                <div class="text-danger">@error('blog_tag_id'){{ $message }}@enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="created_by" class="col-md-3 col-form-label">Created By</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$blog->created_by}}" value="{{old('created_by')}}" name="created_by" id="created_by" placeholder="created_by"/>
                                <div class="text-danger">@error('created_by'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="created_time" class="col-md-3 col-form-label">Created Time</label>
                            <div class="col-md-9">
                                <input type="date" class="form-control" value="{{$blog->created_time}}" value="{{old('created_time')}}" name="created_time" id="created_time" placeholder="created_by"/>
                                <div class="text-danger">@error('created_time'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-md-3 col-form-label">Blog Title</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" value="{{$blog->title}}" value="{{old('title')}}" name="title" id="title" placeholder="Blog title"/>
                                <div class="text-danger">@error('title'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-md-3 col-form-label">Short Description</label>
                            <div class="col-md-9">
                                <textarea type="text" class="form-control" value="{{old('short_description')}}" name="short_description" id="short_description" placeholder="Blog Short Description">{!!$blog->short_description!!}</textarea>
                                <div class="text-danger">@error('short_description'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="long_description" class="col-md-3 col-form-label">Long Description</label>
                            <div class="col-md-9">
                                <textarea type="text" id="summernote" class="form-control" value="{{old('long_description')}}" name="long_description" id="long_description" placeholder="Blog Long Description">{!!$blog->long_description!!}</textarea>
                                <div class="text-danger">@error('long_description'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="logoPng" class="col-md-3 col-form-label">Blog image</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="file" name="image" class="form-control" id="logoPng" accept="image">
                                        <div class="text-danger">@error('image'){{ $message }}@enderror</div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="image-preview" id="image"><img  src="{{asset($blog->image)}}" style="width:70px;height:70px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$blog->status==1?'selected':''}} type="radio" value="1" name="status" checked
                                        id="status1">
                                    <label class="form-check-label" for="status">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$blog->status==0?'selected':''}}  type="radio" value="0" name="status" id="status2">
                                    <label class="form-check-label" for="status">
                                        Unpublished
                                    </label>
                            </div>
                        </div>
                        </div>
                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Update blog info</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>
    @include('admin.layouts.text-editor')
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
            $("#logoPng").change(function() {
                readURL(this, "#image");
            });
        });
    </script>
@endsection
