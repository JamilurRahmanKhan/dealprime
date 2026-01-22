<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    private static $size;

    public static function sizeInfo($request, $id=null){
        $request->validate([
            'name'=>'required',
            'code'=>'required',
        ]);
        if($id != null){
            self::$size=Size::find($id);
        }else{
            self::$size=new Size();
        }
        self::$size->name=$request->name;
        self::$size->code=$request->code;
        self::$size->description=$request->description;
        self::$size->status=$request->status;
        self::$size->save();
    }

    public static function sizeDelete($id){
        self::$size=Size::find($id)->delete();
    }

    public static function checkStatus($id)
    {
        self::$size= self::find($id);
        if (self::$size->status == 1){
            self::$size->status = 0;
        }
        else{
            self::$size->status = 1;
        }
        self::$size->save();
    }

}