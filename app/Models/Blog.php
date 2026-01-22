<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    private static $blog;



    public static function newBlog($request)
    {
        self::$blog = new Blog();

        self::$blog->blog_category_id = $request->blog_category_id;
        // self::$blog->blog_tag_id = $request->blog_tag_id;
        self::$blog->created_by = $request->created_by;
        self::$blog->created_time = $request->created_time;
        self::$blog->title = $request->title;
        self::$blog->short_description = $request->short_description;
        self::$blog->long_description = $request->long_description;
        self::$blog->status = $request->status;
        self::$blog->image = imageUpload($request->image, 'adminAsset/blog/', 'blog-image');
        self::$blog->save();

        return self::$blog;
    }
    public static function updateBlog($request,$id)
    {
        self::$blog = Blog::find($id);

        self::$blog->blog_category_id = $request->blog_category_id;
        self::$blog->created_by = $request->created_by;
        self::$blog->created_time = $request->created_time;
        self::$blog->title = $request->title;
        self::$blog->short_description = $request->short_description;
        self::$blog->long_description = $request->long_description;
        self::$blog->status = $request->status;
        if($request->file('image')){
            if(file_exists(self::$blog->image)){
                unlink(self::$blog->image);
            }
            self::$blog->image = imageUpload($request->image, 'adminAsset/blog/', 'blog-image');
        }
        self::$blog->save();

        return self::$blog;
    }

    public static function blogDelete($id){
        self::$blog=Blog::find($id);
            if(file_exists(self::$blog->image)){
                unlink(self::$blog->image);
            }
            self::$blog->delete();
    }

    public static function checkStatus($id)
    {
        self::$blog=Blog::find($id);
        if (self::$blog->status == 1){
            self::$blog->status = 0;
        }
        else{
            self::$blog->status = 1;
        }
        self::$blog->save();

    }







    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function postTag()
    {
        return $this->hasMany(BlogPostTag::class);
    }

}