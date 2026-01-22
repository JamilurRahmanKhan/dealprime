<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compare extends Model
{
    use HasFactory;
    private static $compare;

    public static function compareInfo($customer_id, $product_id) {
        self::$compare=new Compare();
        self::$compare->customer_id=$customer_id;
        self::$compare->product_id=$product_id;
        self::$compare->save();
    }

    public static function compareDelete($id){
        self::$compare=Compare::find($id)->delete();
    }


    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function productComaperison() {
        return $this->hasMany(ProductComperison::class);
    }
}
