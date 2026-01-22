<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliceStation extends Model
{
    use HasFactory;

    private static $station;

    public static function policeStationInfo($request,$id=null){
        if ($id != null){
            $request->validate([
                'name' => 'required|unique:police_stations,name,' . $id,
                'district_id' => 'required',
            ]);
            self::$station=PoliceStation::find($id);
        }
        else{
            self::$station=new PoliceStation();
            $request->validate([
                'name' => 'required|unique:police_stations,name,',
                'district_id' => 'required',
            ]);
        }
        self::$station->name=$request->name;
        self::$station->district_id=$request->district_id;
        self::$station->status=$request->status;
        self::$station->save();
    }

    public static function stationDelete($id){
        self::$station=PoliceStation::find($id);
            self::$station->delete();
    }

    public static function checkStatus($id)
    {
        self::$station= self::find($id);
        if (self::$station->status == 1){
            self::$station->status = 0;
        }
        else{
            self::$station->status = 1;
        }
        self::$station->save();
    }


    public function district()
    {
        return $this->belongsTo(CourierDistrict::class);
    }
}
