<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;

    private static $SubSubCategory;

    public static  function subSubcategoryInfo($request,$id=null){
        $request->validate([
            'name'=>'required',
            'category_id'=>'required',
            'sub_category_id'=>'required',
        ]);
        if ($id != null){
            self::$SubSubCategory=SubSubCategory::find($id);
        }
        else{
            self::$SubSubCategory=new SubSubCategory();
        }
        self::$SubSubCategory->category_id=$request->category_id;
        self::$SubSubCategory->sub_category_id=$request->sub_category_id;
        self::$SubSubCategory->name=$request->name;
        self::$SubSubCategory->description=$request->description;
        self::$SubSubCategory->status=$request->status;
        if($request->file('image')){
            if(file_exists(self::$SubSubCategory->image)){
                unlink(self::$SubSubCategory->image);
            }
            self::$SubSubCategory->image = imageUpload($request->image, 'adminAsset/SubSubCategory/', 'SubSubCategory-image');
        }

        self::$SubSubCategory->save();
    }

    public static function subSubcategoryDelete($id){
        self::$SubSubCategory=SubSubCategory::find($id);
            if(file_exists(self::$SubSubCategory->image)){
                unlink(self::$SubSubCategory->image);
            }
            self::$SubSubCategory->delete();
    }

    public static function checkStatus($id)
    {
        self::$SubSubCategory= self::find($id);
        if (self::$SubSubCategory->status == 1){
            self::$SubSubCategory->status = 0;
        }
        else{
            self::$SubSubCategory->status = 1;
        }
        self::$SubSubCategory->save();
    }



    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}