<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    private static $blogCategory;

    public static  function blogCategoryInfo($request,$id=null){

        if ($id != null){
            self::$blogCategory=BlogCategory::find($id);
        }
        else{
            $request->validate([
                'name' => 'required|unique:blog_categories',
            ]);
            self::$blogCategory=new BlogCategory();
        }
        self::$blogCategory->name=$request->name;
        self::$blogCategory->status=$request->status;
        self::$blogCategory->description=$request->description;
        if($request->file('image')){
            if(file_exists(self::$blogCategory->image)){
                unlink(self::$blogCategory->image);
            }
            self::$blogCategory->image = imageUpload($request->image, 'adminAsset/blogCategory/', 'blogCategory-image');
        }

        self::$blogCategory->save();
    }


    public static function blogCategoryDelete($id){
        self::$blogCategory=BlogCategory::find($id);
            if(file_exists(self::$blogCategory->image)){
                unlink(self::$blogCategory->image);
            }
            self::$blogCategory->delete();
    }

    public static function checkStatus($id)
    {
        self::$blogCategory=BlogCategory::find($id);
        if (self::$blogCategory->status == 1){
            self::$blogCategory->status = 0;
        }
        else{
            self::$blogCategory->status = 1;
        }
        self::$blogCategory->save();

    }
}