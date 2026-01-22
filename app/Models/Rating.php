<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    private static $rating;

    public static function ratingInfo($request, $id=null){
        $request->validate([
            'review'=>'required',
        ]);
        if($id != null){
            self::$rating=Rating::find($id);
        }else{
            self::$rating=new Rating();
        }
        self::$rating->product_id=$request->product_id;
        self::$rating->customer_id=$request->customer_id;
        self::$rating->product_type=$request->product_type;
        self::$rating->rating=$request->rating;
        self::$rating->review=$request->review;
        self::$rating->status=1;
        self::$rating->save();
    }

    public static function ratingDelete($id){
        self::$rating=rating::find($id)->delete();
    }
    public static function checkStatus($id)
    {
        self::$rating= self::find($id);
        if (self::$rating->status == 1){
            self::$rating->status = 0;
        }
        else{
            self::$rating->status = 1;
        }
        self::$rating->save();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
