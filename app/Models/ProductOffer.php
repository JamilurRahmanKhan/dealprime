<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
    use HasFactory;

    private static $product_offer;

  public static function ProductOfferInfo($request,$id=null){
        $request->validate([
            'product_id'=>'required',
            'discount_amount'=>'required',
        ]);
        if($id!==null){
            self::$product_offer=ProductOffer::find($id);
        }else{
            self::$product_offer=new  ProductOffer();
        }
        self::$product_offer->product_id=$request->product_id;
        self::$product_offer->discount_amount=$request->discount_amount;
        self::$product_offer->status=$request->status;
        if($request->file('image')){
            if(file_exists(self::$product_offer->image)){
                unlink(self::$product_offer->image);
            }
            self::$product_offer->image = imageUpload($request->image, 'adminAsset/product_offer/', 'product_offer-image');
        }
        self::$product_offer->save();
        }


        public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function productOfferDelete($id){
        self::$product_offer=ProductOffer::find($id);
            if(file_exists(self::$product_offer->image)){
                unlink(self::$product_offer->image);
            }
            self::$product_offer->delete();
    }

    public static function checkStatus($id)
    {
        self::$product_offer= self::find($id);
        if (self::$product_offer->status == 1){
            self::$product_offer->status = 0;
        }
        else{
            self::$product_offer->status = 1;
        }
        self::$product_offer->save();

    }
}