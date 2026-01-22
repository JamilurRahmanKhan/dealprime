@extends('website.layouts.master')
@section('title','Blog Details')
@section('body')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog Post</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <article class="post single">
                    <div class="post-media">
                        <img src="{{asset($blogDetail->image)}}" style="height: 300px" alt="Post">
                    </div><!-- End .post-media -->

                    <div class="post-body">
                        <div class="post-date">
                            <span class="day">22</span>
                            <span class="month">Jun</span>
                        </div><!-- End .post-date -->

                        <h2 class="post-title">{{$blogDetail->title}}</h2>

                        <div class="post-meta">
                            <a href="#" class="hash-scroll">0 Comments</a>
                        </div><!-- End .post-meta -->

                        <div class="post-content">
                            {!!$blogDetail->long_description!!}
                        </div><!-- End .post-content -->



                        <div class="post-author">
                            <h3><i class="far fa-user"></i>Author</h3>

                            <figure>
                                <a href="#">
                                    <img src="{{asset('website')}}/assets/images/blog/author.jpg" alt="author">
                                </a>
                            </figure>

                            <div class="author-content">
                                <h4><a href="#">John Doe</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod
                                    odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in
                                    adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis
                                    placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.</p>
                            </div><!-- End .author.content -->
                        </div><!-- End .post-author -->

                        <div class="comment-respond">
                            <h3>Leave a Reply</h3>

                            <form action="#">
                                <p>Your email address will not be published. Required fields are marked *</p>

                                <div class="form-group">
                                    <label>Comment</label>
                                    <textarea cols="30" rows="1" class="form-control" required></textarea>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" required>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" required>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="url" class="form-control">
                                </div><!-- End .form-group -->

                                <div class="form-group-custom-control mb-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="save-name">
                                        <label class="custom-control-label" for="save-name">Save my name, email,
                                            and website in this browser for the next time I comment.</label>
                                    </div><!-- End .custom-checkbox -->
                                </div><!-- End .form-group-custom-control -->

                                <div class="form-footer my-0">
                                    <button type="submit" class="btn btn-sm btn-primary">Post
                                        Comment</button>
                                </div><!-- End .form-footer -->
                            </form>
                        </div><!-- End .comment-respond -->
                    </div><!-- End .post-body -->
                </article><!-- End .post -->

                <hr class="mt-2 mb-1">
            </div><!-- End .col-lg-9 -->

            <div class="sidebar-toggle custom-sidebar-toggle">
                <i class="fas fa-sliders-h"></i>
            </div>
            <div class="sidebar-overlay"></div>
            <aside class="sidebar mobile-sidebar col-lg-3">
                <div class="sidebar-wrapper" data-sticky-sidebar-options='{"offsetTop": 72}'>
                    <div class="widget widget-categories">
                        <h4 class="widget-title">Blog Categories</h4>

                        <ul class="list">
                            @foreach ($blogCategories as $blogCategory)
                            <li><a href="{{route('blog',['id'=>$blogCategory->id])}}">{{$blogCategory->name}}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- End .widget -->

                    <div class="widget">
                        <h4 class="widget-title">Recent Posts</h4>

                        <ul class="simple-post-list">
                            @foreach ($recentBlogs as $blog)
                            <li>
                                <div class="post-media">
                                    <a href="{{route('blog.details',['id'=>$blog->id])}}">
                                        <img src="{{asset($blog->image)}}" alt="Post">
                                    </a>
                                </div><!-- End .post-media -->
                                <div class="post-info">
                                    <a href="{{route('blog.details',['id'=>$blog->id])}}">{{$blog->title}}</a>
                                    <div class="post-meta">
                                        April 08, 2018
                                    </div><!-- End .post-meta -->
                                </div><!-- End .post-info -->
                            </li>
                            @endforeach
                        </ul>
                    </div><!-- End .widget -->

                    <div class="widget">
                        <h4 class="widget-title">Tags</h4>

                        <div class="tagcloud">
                            @foreach ($blogTags as $blogTag)

                            <a href="#">{{$blogTag->name}}</a>
                            @endforeach

                        </div><!-- End .tagcloud -->
                    </div><!-- End .widget -->
                </div><!-- End .sidebar-wrapper -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</main><!-- End .main -->
@endsection
