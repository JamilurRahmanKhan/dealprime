<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    private static $tag;

    public static function tagInfo($request, $id=null){
        $request->validate([
            'name'=>'required',
        ]);
        if($id != null){
            self::$tag=Tag::find($id);
        }else{
            self::$tag=new Tag();
        }
        self::$tag->name=$request->name;
        self::$tag->status=$request->status;
        self::$tag->save();
    }

    public static function tagDelete($id){
        self::$tag=Tag::find($id)->delete();
    }
    public static function checkStatus($id)
    {
        self::$tag= self::find($id);
        if (self::$tag->status == 1){
            self::$tag->status = 0;
        }
        else{
            self::$tag->status = 1;
        }
        self::$tag->save();
    }
}