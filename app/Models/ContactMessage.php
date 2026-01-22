<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    private static $message;

    public static function contactMessageInfo($request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required|min:11|digits:11',
            'message'=>'required',

        ]);
        self::$message=new ContactMessage();
        self::$message->name=$request->name;
        self::$message->email=$request->email;
        self::$message->phone=$request->phone;
        self::$message->message=$request->message;
        self::$message->save();

    }
}
