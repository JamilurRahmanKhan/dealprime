@extends('website.layouts.master')
@section('title','Blog')
@section('body')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog</li>
            </ol>
        </div><!-- End .container -->
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="blog-section row">
                    @foreach ($blogs as $blog )
                    <div class="col-md-6 col-lg-4">
                        <article class="post">
                            <div class="post-media">
                                <a href="{{route('blog.details',['id'=>$blog->id])}}">
                                    <img src="{{asset($blog->image)}}" style="height: 200px;" alt="Post" width="225"
                                        height="280">
                                </a>
                                    <div class="post-date">
                                        <span class="day">{{ \Carbon\Carbon::parse($blog->created_time)->format('d') }}</span>
                                        <span class="month">{{ \Carbon\Carbon::parse($blog->created_time)->format('M') }}</span>
                                    </div>
                            </div><!-- End .post-media -->

                            <div class="post-body">
                                <h2 class="post-title">
                                    <a href="{{route('blog.details',['id'=>$blog->id])}}">{{$blog->title}}</a>
                                </h2>
                                <div class="post-content">
                                    <p>{{$blog->short_description}}</p>
                                </div><!-- End .post-content -->
                                <a href="single.html" class="post-comment">0 Comments</a>
                            </div><!-- End .post-body -->
                        </article><!-- End .post -->
                    </div>
                    @endforeach
                </div>
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
                            @foreach ($blogCategories as $blogCategory )
                            <li><a href="{{route('blog',['id'=>$blogCategory->id])}}">{{$blogCategory->name}}</a></li>
                            @endforeach

                        </ul>
                    </div><!-- End .widget -->

                    <div class="widget widget-post">
                        <h4 class="widget-title">Recent Posts</h4>

                        <ul class="simple-post-list">
                            @foreach ($recentBlogs as $recentBlog )
                            <li>
                                <div class="post-media">
                                    <a href="{{route('blog.details',['id'=>$recentBlog->id])}}">
                                        <img src="{{asset($recentBlog->image)}}" alt="Post">
                                    </a>
                                </div><!-- End .post-media -->
                                <div class="post-info">
                                    <a href="{{route('blog.details',['id'=>$recentBlog->id])}}">{{$recentBlog->title}}</a>
                                    <div class="post-meta">{{ \Carbon\Carbon::parse($blog->created_time)->format('F d, Y') }}</div>
                                    <!-- End .post-meta -->
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
