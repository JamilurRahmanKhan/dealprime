<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    use HasFactory;

    private static $blogTag;

    public static function blogTagInfo($request, $id=null){
        if($id != null){
            self::$blogTag=BlogTag::find($id);
            $request->validate([
                'name'=>'required',
            ]);
        }else{
            self::$blogTag=new BlogTag();
            $request->validate([
                'name'=>'required|unique:blog_tags',
            ]);
        }
        self::$blogTag->name=$request->name;
        self::$blogTag->status=$request->status;
        self::$blogTag->save();
    }

    public static function blogTagDelete($id){
        self::$blogTag=blogTag::find($id)->delete();
    }
    public static function checkStatus($id)
    {
        self::$blogTag= self::find($id);
        if (self::$blogTag->status == 1){
            self::$blogTag->status = 0;
        }
        else{
            self::$blogTag->status = 1;
        }
        self::$blogTag->save();
    }
}