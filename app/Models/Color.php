<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    private static $color;

    public static function colorInfo($request , $id=null) {
        if($id !=null){
            self::$color=Color::find($id);
        }else{
            self::$color=new Color();
            $request->validate([
                'category_id'=>'required',
                'name'=>'required',
            ]);
        }
        self::$color->category_id=$request->category_id;
        self::$color->name=$request->name;
        self::$color->code=$request->code;
        self::$color->description=$request->description;
        self::$color->status=$request->status;
        self::$color->save();
    }

    public static function colorDelete($id){
        self::$color=Color::find($id)->delete();
    }

    public static function checkStatus($id)
    {
        self::$color= self::find($id);
        if (self::$color->status == 1){
            self::$color->status = 0;
        }
        else{
            self::$color->status = 1;
        }
        self::$color->save();

    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}