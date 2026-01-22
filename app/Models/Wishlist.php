<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Wishlist extends Model
{
    use HasFactory;
    private static $wishlist;


    public static function wishlistDelete($id){
        self::$wishlist= Wishlist::find($id)->delete();
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}