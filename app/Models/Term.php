<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    private static $terms;

    public static function termsInfo($request, $id=null){
        $request->validate([
            'terms_and_condition'=>'required',
            'terms_type'=>'required',
        ]);
        if($id != null){
            self::$terms=Term::find($id);
            
        }else{
            self::$terms=new Term();
            
        }
        self::$terms->terms_and_condition=$request->terms_and_condition;
        self::$terms->terms_type=$request->terms_type;
        self::$terms->user_type=$request->user_type;
        self::$terms->save();
    }

    public static function termsDelete($id){
        self::$terms=Term::find($id)->delete();
    }
}