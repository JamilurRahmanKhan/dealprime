<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopUp extends Model
{
    use HasFactory;
    private static $popUp;

    public static function popUpInfo($request, $id=null){

        if($id != null){
            self::$popUp=PopUp::find($id);
            $request->validate([
                'image' => 'nullable',

            ]);

        }else{
            self::$popUp=new PopUp();
            $request->validate([
                'image' => 'required',

            ]);

        }
        if($request->file('image')){
            if(file_exists(self::$popUp->image)){
                unlink(self::$popUp->image);
            }
            self::$popUp->image = imageUpload($request->image, 'adminAsset/popUp/', 'popup-image');
        }
        self::$popUp->image_link=$request->image_link;
        self::$popUp->status=$request->status;
        self::$popUp->save();
    }

    public static function popUpDelete($id){
        self::$popUp=PopUp::find($id);
        if(file_exists(self::$popUp->image)){
            unlink(self::$popUp->image);
        }
        self::$popUp->delete();

    }

    public static function checkStatus($id)
    {
        self::$popUp= self::find($id);
        if (self::$popUp->status == 1){
            self::$popUp->status = 2;
        }
        else if (self::$popUp->status == 2){
            self::$popUp->status = 1;
        }
        self::$popUp->save();
    }
}