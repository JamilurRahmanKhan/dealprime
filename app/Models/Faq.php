<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    private static $faq;

    public static function faqInfo($request , $id=null) {
        if($id !=null){
            self::$faq=Faq::find($id);
            $request->validate([
                'question'=>'required',
                'answer'=>'required',
            ]);
        }else{
            self::$faq=new Faq();
            $request->validate([
                'question'=>'required',
                'answer'=>'required',
            ]);
        }
        self::$faq->question=$request->question;
        self::$faq->answer=$request->answer;
        self::$faq->status=$request->status;
        self::$faq->save();
    }

    public static function faqDelete($id){
        self::$faq=Faq::find($id)->delete();
    }

    public static function checkStatus($id)
    {
        self::$faq= self::find($id);
        if (self::$faq->status == 1){
            self::$faq->status = 0;
        }
        else{
            self::$faq->status = 1;
        }
        self::$faq->save();

    }
}