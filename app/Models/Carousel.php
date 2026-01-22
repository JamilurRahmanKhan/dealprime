<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;

    private static $carousel;

    public static function carouselInfo($request,$id=null){
        // return $request->all();
        $request->validate([
            'product_id'=>'required',
          'title' => ['required', function ($attribute, $value, $fail) {
            $wordCount = str_word_count($value);
            if ($wordCount > 15) {
                $fail('The :attribute may not contain more than 15 words.');
            }
        }],
        'short_details' => ['required', function ($attribute, $value, $fail) {
            $wordCount = str_word_count($value);
            if ($wordCount > 30) {
                $fail('The :attribute may not contain more than 30 words.');
            }
        }],
        ]);
        if ($id != null){
            self::$carousel=Carousel::find($id);
        }
        else{
            self::$carousel=new Carousel();
        }
        self::$carousel->product_id=$request->product_id;
        self::$carousel->title=$request->title;
        self::$carousel->status=$request->status;
        self::$carousel->short_details=$request->short_details;
        if($request->file('image')){
            if(file_exists(self::$carousel->image)){
                unlink(self::$carousel->image);
            }
            self::$carousel->image = imageUpload($request->image, 'adminAsset/carousel/', 'carousel-image');
        }
        self::$carousel->save();
    }

    public static function carouselDelete($id){
        self::$carousel=Carousel::find($id);
            if(file_exists(self::$carousel->image)){
                unlink(self::$carousel->image);
            }
            self::$carousel->delete();
    }
    public static function checkStatus($id)
    {
        self::$carousel= self::find($id);
        if (self::$carousel->status == 1){
            self::$carousel->status = 0;
        }
        else{
            self::$carousel->status = 1;
        }
        self::$carousel->save();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}