<?php

namespace App\Models;

use App\Models\ComboProductDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComboProduct extends Model
{
    use HasFactory;

    private static $combo;

    public static function comboInfo($request) {

        self::$combo=new ComboProduct();
        $request->validate([
            'name'=>'required',
            'product_id'=>'required',
            'discount_type'=>'required',
            'discount_amount'=>'required',
            'code'=>'required',
            'merchant_id'=>'required',
            'stock_amount'=>'required',
            // 'image'=>'required',
            'image' => ['required', 'image','mimes:jpeg,png,jpg,gif','max:2048', // Max file size 2MB
            function ($attribute, $value, $fail) {
                if ($value) {
                    // Validate file size
                    if ($value->getSize() > 2 * 1024 * 1024) { // 2MB in bytes
                        $fail('The ' . $attribute . ' must not exceed 2MB in size.');
                    }
                    // Validate dimensions
                    $image = getimagesize($value);
                    if ($image) {
                        $width = $image[0];
                        $height = $image[1];
                        if ($width != 300 || $height != 300) {
                            $fail('The ' . $attribute . ' must be exactly 300x300 pixels.');
                        }
                    } else {
                        $fail('The uploaded file is not a valid image.');
                    }
                }
            },
        ],
        ]);
        if($request->discount_type=='percentage'){
            self::$combo->selling_price=$request->regular_price - ($request->regular_price * $request->discount_amount / 100);
        }elseif($request->discount_type=='flat'){
            self::$combo->selling_price=$request->regular_price - $request->discount_amount;
        }
        self::$combo->name=$request->name;
        self::$combo->merchant_id=$request->merchant_id;
        self::$combo->code=$request->code;
        self::$combo->regular_price=$request->regular_price;
        self::$combo->discount_type=$request->discount_type;
        self::$combo->discount_amount=$request->discount_amount;
        self::$combo->stock_amount=$request->stock_amount;
        self::$combo->short_description=$request->short_description;
        self::$combo->long_description=$request->long_description;
        self::$combo->status=$request->status;
        self::$combo->image = imageUpload($request->image, 'adminAsset/combo-product/', 'combo');
        self::$combo->save();

        return self::$combo;
    }
    public static function comboUpdate($request,$id) {
        $request->validate([
            'name'=>'required',
            'product_id'=>'required',
            'discount_type'=>'required',
            'discount_amount'=>'required',
            'stock_amount'=>'required',
            // 'image' => 'nullable',
            'image' => ['nullable','image','mimes:jpeg,png,jpg,gif', 'max:2048',
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $image = getimagesize($value);
                        if ($image[0] != 300 || $image[1] != 300) {
                            $fail('The ' . $attribute . ' must be exactly 300x300 pixels.');
                        }
                    }
                },
        ],
        ]);
        self::$combo=ComboProduct::find($id);
        if($request->discount_type=='percentage'){
            self::$combo->selling_price=$request->regular_price - ($request->regular_price * $request->discount_amount / 100);
        }elseif($request->discount_type=='flat'){
            self::$combo->selling_price=$request->regular_price - $request->discount_amount;
        }
        self::$combo->name=$request->name;
        self::$combo->merchant_id=$request->merchant_id;
        self::$combo->regular_price=$request->regular_price;
        self::$combo->discount_type=$request->discount_type;
        self::$combo->discount_amount=$request->discount_amount;
        self::$combo->stock_amount=$request->stock_amount;
        self::$combo->short_description=$request->short_description;
        self::$combo->long_description=$request->long_description;
        self::$combo->status=$request->status;
        if($request->file('image')){
            if(file_exists(self::$combo->image)){
                unlink(self::$combo->image);
            }
            self::$combo->image = imageUpload($request->image, 'adminAsset/combo-product/', 'combo');
        }
        self::$combo->save();
        return self::$combo;
    }

    public static function comboDelete($comboProduct){
        self::$combo=ComboProductDetail::where('combo_product_id',$comboProduct->id)->delete();
        self::$combo=ComboProduct::find($comboProduct->id);
        if(file_exists(self::$combo->image)){
            unlink(self::$combo->image);
        }
        self::$combo->delete();
    }

    public static function checkStatus($id)
    {
        self::$combo= self::find($id);
        if (self::$combo->status == 1){
            self::$combo->status = 0;
        }
        else{
            self::$combo->status = 1;
        }
        self::$combo->save();

    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function comboDetails()
    {
        return $this->hasMany(ComboProductDetail::class);
    }
}