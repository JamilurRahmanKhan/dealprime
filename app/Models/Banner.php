<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    private static $banner;

    public static function bannerInfo($request,$id=null){
        if ($id != null){
            self::$banner=Banner::find($id);
            $request->validate([
                'image_url'=>'required',
                'banner_position'=>'required',
                'image' => [
                    'required',
                    'image',
                    'mimes:jpeg,png,jpg,gif',
                    'max:2048', // Max file size 2MB
                    function ($attribute, $value, $fail) {
                        if ($value) {
                            // Validate file size
                            if ($value->getSize() > 2 * 1024 * 1024) { // 2MB in bytes
                                $fail('The image is invalid. Please upload a valid image with 1920x300 dimensions and max 2MB size.');
                                return;
                            }
                            // Validate dimensions
                            $image = getimagesize($value);
                            if ($image) {
                                $width = $image[0];
                                $height = $image[1];
                                if ($width != 1920 || $height != 300) {
                                    $fail('The image is invalid. Please upload a valid image with 1920x300 dimensions and max 2MB size.');
                                    return;
                                }
                            } else {
                                $fail('The image is invalid. Please upload a valid image with 1920x300 dimensions and max 2MB size.');
                                return;
                            }
                        }
                    },
                ],
            ]);
        }
        else{
            self::$banner=new Banner();
            // $request->validate([
            //     'image'=>'required',
            //     'image_url'=>'required',
            //     'banner_position'=>'required',

            // ]);
        }
        self::$banner->image_url=$request->image_url;
        self::$banner->banner_position=$request->banner_position;
        self::$banner->status=$request->status;
        if($request->file('image')){
            if(file_exists(self::$banner->image)){
                unlink(self::$banner->image);
            }
            self::$banner->image = imageUpload($request->image, 'adminAsset/banner/', 'banner-image');
        }
        self::$banner->save();
    }

    public static function bannerDelete($id){
        self::$banner=Banner::find($id);
            if(file_exists(self::$banner->image)){
                unlink(self::$banner->image);
            }
            self::$banner->delete();
    }
}