<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    private static $subCategory;

    public static function subCategoryInfo($request, $id=null){
        $request->validate([
            'name'=>'required',
            'category_id'=>'required',
        ]);
        if($id != null){
            self::$subCategory=SubCategory::find($id);
        }else{
            self::$subCategory=new SubCategory();
        }
        self::$subCategory->category_id=$request->category_id;
        self::$subCategory->name=$request->name;
        self::$subCategory->description=$request->description;
        self::$subCategory->status=$request->status;
        if($request->file('image')){
            if(file_exists(self::$subCategory->image)){
                unlink(self::$subCategory->image);
            }
            self::$subCategory->image = imageUpload($request->image, 'adminAsset/sub-category/', 'subCat-image');
        }
        self::$subCategory->save();
    }

    public static function subCategoryDelete($id){
        self::$subCategory=SubCategory::find($id);
        if(file_exists(self::$subCategory->image)){
            unlink(self::$subCategory->image);
        }
        self::$subCategory->delete();
    }

    public static function checkStatus($id)
    {
        self::$subCategory= self::find($id);
        if (self::$subCategory->status == 1){
            self::$subCategory->status = 0;
        }
        else{
            self::$subCategory->status = 1;
        }
        self::$subCategory->save();

    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subSubCategory()
    {
        return $this->hasMany(SubSubCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class)->where('status', 1);
    }
}
