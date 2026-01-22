<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierDistrict extends Model
{
    use HasFactory;

    private static $district;

    public static function districtInfo($request,$id=null){
        if ($id != null){
            $request->validate([
                'name' => 'required|unique:courier_districts,name,' . $id,
            ]);
            self::$district=CourierDistrict::find($id);
        }
        else{
            self::$district=new CourierDistrict();
            $request->validate([
                'name' => 'required|unique:courier_districts,name,',
            ]);
        }
        // self::$district->division_id=$request->division_id;
        self::$district->name=$request->name;
        self::$district->status=$request->status;
        self::$district->save();
    }

    public static function districtDelete($id){
        self::$district=CourierDistrict::find($id);
            self::$district->delete();
    }

    public static function checkStatus($id)
    {
        self::$district= self::find($id);
        if (self::$district->status == 1){
            self::$district->status = 0;
        }
        else{
            self::$district->status = 1;
        }
        self::$district->save();
    }

    
}
