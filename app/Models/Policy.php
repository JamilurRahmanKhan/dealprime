<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    private static $policy;

    public static function policyInfo($request, $id=null){

        if($id != null){
            self::$policy=Policy::find($id);
            $request->validate([
                'image' => 'nullable',
                'title' => ['required', function ($attribute, $value, $fail) {
                $wordCount = str_word_count($value);
                if ($wordCount > 5) {
                    $fail('The :attribute may not contain more than 5 words.');
                }
            }],
                'sub_title' => ['required', function ($attribute, $value, $fail) {
                $wordCount = str_word_count($value);
                if ($wordCount > 10) {
                    $fail('The :attribute may not contain more than 10 words.');
                }
            }],
            ]);
        }else{
            self::$policy=new Policy();
            $request->validate([
                'image' => 'required',
                'title' => ['required', function ($attribute, $value, $fail) {
                $wordCount = str_word_count($value);
                if ($wordCount > 5) {
                    $fail('The :attribute may not contain more than 5 words.');
                }
            }],
                'sub_title' => ['required', function ($attribute, $value, $fail) {
                $wordCount = str_word_count($value);
                if ($wordCount > 10) {
                    $fail('The :attribute may not contain more than 10 words.');
                }
            }],
            ]);
        }
        if($request->file('image')){
            if(file_exists(self::$policy->image)){
                unlink(self::$policy->image);
            }
            self::$policy->image = imageUpload($request->image, 'adminAsset/policy/', 'policy-image');
        }
        self::$policy->title=$request->title;
        self::$policy->sub_title=$request->sub_title;
        self::$policy->save();
    }

    public static function policyDelete($id){
        self::$policy=Policy::find($id);
        if(file_exists(self::$policy->image)){
            unlink(self::$policy->image);
        }
        self::$policy->delete();

    }
}