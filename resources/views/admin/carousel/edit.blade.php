@extends('admin.layouts.master')
@section('title')Carousel Edit @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('carousels.index')}}">Carousel Manage</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Carousel Edit</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Carousel Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Carousel form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{ route('carousels.update',$carousel->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label for="image" class="col-md-3 col-form-label">Carousel Image</label>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="imageInput" name="image">
                                    <div class="text-danger">@error('image'){{$message}} @enderror</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group ">
                                    <img id="imagePreview" src="{{ asset($carousel->image) }}" alt="Your Image"
                                    class="img-fluid" style="display:{{ $carousel->image ? 'block' : 'none' }}" />                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label">Product Name</label>
                            <div class="col-md-9">
                                <select name="product_id" class="form-control">
                                    <option disabled >------------Select product----------</option>
                                    @foreach ($products as $product)
                                    <option value="{{$product->id}}"{{$product->id==$carousel->product_id?'selected':''}} >{{$product->name}}</option>
                                    @endforeach
                                </select>
                            <div class="text-danger">@error('product_id'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-md-3 col-form-label">Carousel Title</label>
                            <div class="col-md-9">
                                <small>Note: Title should not be more than 15 word.</small>
                                <textarea name="title" class="form-control"  placeholder="Carousel title" id="title" cols="3" rows="3">{!! old('title',$carousel->title) !!}</textarea>
                            <div class="text-danger">@error('title'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="details" class="col-md-3 col-form-label">Short details</label>
                            <div class="col-md-9">
                                <small>Note: Short details should not be more than 30 word.</small>
                                <textarea name="short_details" class="form-control" placeholder="Short Details" id="details" cols="3" rows="3">{!!$carousel->short_details!!}</textarea>
                                <div class="text-danger">@error('short_details'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 pt-0 col-form-label">Publication Status</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" {{$carousel->status==1?'checked':''}} type="radio" value="1" name="status" checked
                                        id="status1">
                                    <label class="form-check-label" for="status">
                                        Published
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input"  {{$carousel->status==0?'checked':''}} type="radio" value="0" name="status" id="status2">
                                    <label class="form-check-label" for="status">
                                        Unpublished
                                    </label>
                            </div>
                        </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9 mt-2">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>


@endsection
