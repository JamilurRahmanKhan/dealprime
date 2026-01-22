<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    private static $about;

    public static function aboutInfo($request,$id=null){
        if ($id != null){
            self::$about=About::find($id);
            $request->validate([
            'about'=>'required',
            ]);
        }
        else{
            self::$about=new about();
            $request->validate([
               'about'=>'required',

            ]);
        }
        self::$about->about=$request->about;
        self::$about->status=$request->status;
        self::$about->save();
    }

    public static function aboutDelete($id){
        self::$about=About::find($id);
        self::$about->delete();
    }

    public static function checkStatus($id)
    {
        self::$about= self::find($id);
        if (self::$about->status == 1){
            self::$about->status = 0;
        }
        else if (self::$about->status == 0){
            self::$about->status = 1;
        }
        self::$about->save();

    }
}