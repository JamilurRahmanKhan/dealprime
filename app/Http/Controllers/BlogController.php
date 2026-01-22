<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\BlogPostTag;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    private $blog;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!userCan('blogs.index'),403);
        return view('admin.blog.index',[
            'blogs'=>Blog::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!userCan('blogs.create'),403);
        return view('admin.blog.create',[
            'blogCategories'=>BlogCategory::where('status',1)->get(),
            'blogTags'=>BlogTag::where('status',1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(!userCan('blogs.create'),403);
        $request->validate([
            'blog_category_id'=>'required',
            'blog_tag_id'=>'required',
            'title'=>'required',
            'created_by'=>'required',
            'created_time'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
        ]);
        $this->blog = Blog::newBlog($request);
        BlogPostTag::newBlogTag($request->blog_tag_id, $this->blog->id);

        Session::flash('success','Blog  Added successfully');
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        abort_if(!userCan('blogs.show'),403);
        return view('admin.blog.show',[
            'blog'=>Blog::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_if(!userCan('blogs.edit'),403);
        return view('admin.blog.edit',[
            'blog'=>Blog::find($id),
            'blogCategories'=>BlogCategory::where('status',1)->get(),
            'blogTags'=>BlogTag::where('status',1)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_if(!userCan('blogs.edit'),403);
         $request->validate([
            'blog_category_id'=>'required',
            'blog_tag_id'=>'required',
            'title'=>'required',
            'created_by'=>'required',
            'created_time'=>'required',
            'short_description'=>'required',
            'long_description'=>'required',
        ]);
        $this->blog = Blog::updateBlog($request,$id);
        BlogPostTag::updateBlogTag($request->blog_tag_id, $this->blog->id);

        Session::flash('success','Blog  Updated successfully');
        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_if(!userCan('blogs.destroy'),403);
        Blog::blogDelete($id);
        Session::flash('success','Blog  Delete Successfully'); ;
        return redirect()->route('blogs.index');
    }

    public function blogStatus( $id)
    {
        abort_if(!userCan('blogs.edit'),403);

        Blog::checkStatus($id);
        Session::flash('success','Status updated Successfully'); ;
        return redirect()->route('blogs.index');
    }
}