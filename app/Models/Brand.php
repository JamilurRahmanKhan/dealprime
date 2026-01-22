<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    private static $brand;

    public static function brandInfo($request,$id=null){
        // return $request->all() ;
        $request->validate([
            'name'=>'required',
          
        ]);
        if ($id != null){
            self::$brand=Brand::find($id);
        }
        else{
            self::$brand=new Brand();
        }
        self::$brand->name=$request->name;
        self::$brand->description=$request->description;
        self::$brand->status=$request->status;
        if($request->file('image')){
            if(file_exists(self::$brand->image)){
                unlink(self::$brand->image);
            }
            self::$brand->image = imageUpload($request->image, 'adminAsset/brand/', 'brand-image');
        }
        self::$brand->save();
    }

    public static function brandDelete($id){
        self::$brand=Brand::find($id);
            if(file_exists(self::$brand->image)){
                unlink(self::$brand->image);
            }
            self::$brand->delete();
    }
    public static function checkStatus($id)
    {
        self::$brand= self::find($id);
        if (self::$brand->status == 1){
            self::$brand->status = 0;
        }
        else{
            self::$brand->status = 1;
        }
        self::$brand->save();
    }

}