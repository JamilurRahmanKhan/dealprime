<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboProductDetail extends Model
{
    use HasFactory;
    private static $comboDetails;

    public static function comboProductDetailsStore($productId,$combo_id){
        foreach ($productId as $product) {
            self::$comboDetails = new ComboProductDetail();
            self::$comboDetails->combo_product_id = $combo_id;
            self::$comboDetails->product_id = $product;
            self::$comboDetails->save();
        }
    }
    public static function comboProductDetailsUpdate($productId,$combo_id){
        self::$comboDetails = ComboProductDetail::where('combo_product_id', $combo_id)->get();
        foreach (self::$comboDetails as $comboDetail) {
            $comboDetail->delete();
        }

        self::comboProductDetailsStore($productId,$combo_id);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function comboProduct()
    {
        return $this->belongsTo(ComboProduct::class);
    }
}