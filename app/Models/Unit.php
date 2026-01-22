<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    private static $unit;

    public static function unitInfo($request, $id=null){

        if($id != null){
            self::$unit=Unit::find($id);
            $request->validate([
                'name'=>'required|unique:units,name,'.$id,
                'code'=>'required|unique:units,code,'.$id,
            ]);
        }else{
            self::$unit=new Unit();
            $request->validate([
                'name'=>'required|unique:units,name',
                'code'=>'required|unique:units,code',
            ]);
        }
        self::$unit->name=$request->name;
        self::$unit->code=$request->code;
        self::$unit->description=$request->description;
        self::$unit->status=$request->status;
        self::$unit->save();
    }

    public static function unitDelete($id){
        self::$unit=Unit::find($id)->delete();
    }
    public static function checkStatus($id)
    {
        self::$unit= self::find($id);
        if (self::$unit->status == 1){
            self::$unit->status = 0;
        }
        else{
            self::$unit->status = 1;
        }
        self::$unit->save();
    }

}