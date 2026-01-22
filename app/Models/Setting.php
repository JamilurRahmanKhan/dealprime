<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    private static $setting, $imageUrl;

    public static function newSetting( $request )
    {
        self::$setting = new Setting();

        self::$setting->company_name        = $request->company_name;
        self::$setting->contact_phone       = $request->contact_phone;
        self::$setting->support_phone       = $request->support_phone;
        self::$setting->contact_email       = $request->contact_email;
        self::$setting->support_email       = $request->support_email;
        self::$setting->support_hours       = $request->support_hours;
        self::$setting->facebook            = $request->facebook;
        self::$setting->twitter             = $request->twitter;
        self::$setting->instagram           = $request->instagram;
        self::$setting->google_map          = $request->google_map;
        self::$setting->company_address     = $request->company_address;
         self::$setting->trade_no            = $request->trade_no;
         self::$setting->tin_no              = $request->tin_no;

        if ($request->file('logo_png')) {
            self::$setting->logo_png = imageUpload($request->file('logo_png'),'adminAsset/img/setting/');
        }


        if ($request->file('payment_method_image')) {
            self::$setting->payment_method_image = imageUpload($request->file('payment_method_image'),'adminAsset/img/setting/');
        }


        if ($request->file('favicon')) {
            self::$setting->favicon = imageUpload($request->file('favicon'),'adminAsset/img/setting/');
        }

        self::$setting->save();
    }


    public static function updateSetting($request, $setting)
    {
         self::$setting =Setting::find($setting->id);
         self::$setting->company_name        = $request->company_name;
         self::$setting->contact_phone       = $request->contact_phone;
         self::$setting->support_phone       = $request->support_phone;
         self::$setting->contact_email       = $request->contact_email;
         self::$setting->support_email       = $request->support_email;
         self::$setting->support_hours       = $request->support_hours;
         self::$setting->facebook            = $request->facebook;
         self::$setting->twitter             = $request->twitter;
         self::$setting->instagram           = $request->instagram;
         self::$setting->google_map          = $request->google_map;
         self::$setting->company_address     = $request->company_address;
         self::$setting->trade_no            = $request->trade_no;
         self::$setting->tin_no              = $request->tin_no;

            // if($request->file('android_app_image')){
            //     if(file_exists(self::$setting->android_app_image)){
            //         unlink(self::$setting->android_app_image);
            //     }
            //     self::$setting->android_app_image = imageUpload($request->file('android_app_image'),'adminAsset/img/setting/');
            // }

            // if($request->file('ios_app_image')){
            //     if(file_exists(self::$setting->ios_app_image)){
            //         unlink(self::$setting->ios_app_image);
            //     }
            //     self::$setting->ios_app_image = imageUpload($request->file('ios_app_image'),'adminAsset/img/setting/');
            // }

            //  if($request->file('logo_jpg')){
            //     if(file_exists(self::$setting->logo_jpg)){
            //         unlink(self::$setting->logo_jpg);
            //     }
            //     self::$setting->logo_jpg = imageUpload($request->file('logo_jpg'),'adminAsset/img/setting/');
            // }

            if($request->file('logo_png')){
                if(file_exists(self::$setting->logo_png)){
                    unlink(self::$setting->logo_png);
                }
                self::$setting->logo_png = imageUpload($request->file('logo_png'),'adminAsset/img/setting/');
            }

            if($request->file('payment_method_image')){
                if(file_exists(self::$setting->payment_method_image)){
                    unlink(self::$setting->payment_method_image);
                }
                self::$setting->payment_method_image = imageUpload($request->file('payment_method_image'),'adminAsset/img/setting/');
            }


            if($request->file('favicon')){
                if(file_exists(self::$setting->favicon)){
                    unlink(self::$setting->favicon);
                }
                self::$setting->favicon = imageUpload($request->file('favicon'),'adminAsset/img/setting/');
            }

        self::$setting->save();
    }
}