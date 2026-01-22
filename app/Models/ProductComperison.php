<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductComperison extends Model
{
    private static $productCompare;

    public static function newproductComperison($request,$id){

        $key_name_arr = $request->key_name;
        $key_value_arr = $request->key_value;
        foreach ($key_name_arr as $key => $v){
            self::$productCompare = new ProductComperison();
            self::$productCompare->product_id = $id;
            self::$productCompare->key_name = $key_name_arr[$key];
            self::$productCompare->key_value = $key_value_arr[$key];
            self::$productCompare->save();
        }
    }

    public static function updateProductComperison($request,$id){

        self::$productCompare = ProductComperison::where('product_id', $id)->get();
        foreach (self::$productCompare as $productCom) {
            $productCom->delete();
        }
        self::newproductComperison($request,$id);

    }


}
