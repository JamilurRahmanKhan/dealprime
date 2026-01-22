<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    private static $category;

    public static  function categoryInfo($request,$id=null){
        if ($id != null){
            self::$category=Category::find($id);
            $request->validate([
                'name' => 'required|unique:categories,name,'. $id,
                'image' => ['nullable', 'image','mimes:jpeg,png,jpg,gif','max:2048', // Max file size 2MB
                    function ($attribute, $value, $fail) {
                        if ($value) {
                            // Validate file size
                            if ($value->getSize() > 2 * 1024 * 1024) { // 2MB in bytes
                                $fail('The ' . $attribute . ' must not exceed 2MB in size.');
                            }
                            // Validate dimensions
                            $image = getimagesize($value);
                            if ($image) {
                                $width = $image[0];
                                $height = $image[1];
                                if ($width != 300 || $height != 300) {
                                    $fail('The ' . $attribute . ' must be exactly 300x300 pixels.');
                                }
                            } else {
                                $fail('The uploaded file is not a valid image.');
                            }
                        }
                    },
                ],
            ]);
        }
        else{
            self::$category=new Category();
            $request->validate([
                'name' => 'required|unique:categories',
                'image' => ['required', 'image','mimes:jpeg,png,jpg,gif','max:2048', // Max file size 2MB
                function ($attribute, $value, $fail) {
                    if ($value) {
                        // Validate file size
                        if ($value->getSize() > 2 * 1024 * 1024) { // 2MB in bytes
                            $fail('The ' . $attribute . ' must not exceed 2MB in size.');
                        }
                        // Validate dimensions
                        $image = getimagesize($value);
                        if ($image) {
                            $width = $image[0];
                            $height = $image[1];
                            if ($width != 300 || $height != 300) {
                                $fail('The ' . $attribute . ' must be exactly 300x300 pixels.');
                            }
                        } else {
                            $fail('The uploaded file is not a valid image.');
                        }
                    }
                },
            ],
        ]);

        }
        self::$category->name=$request->name;
        self::$category->status=$request->status;
        self::$category->description=$request->description;
        if($request->file('image')){
            if(file_exists(self::$category->image)){
                unlink(self::$category->image);
            }
            self::$category->image = imageUpload($request->image, 'adminAsset/category/', 'category-image');
        }

        self::$category->save();
    }

    public static function categoryDelete($id){
        self::$category=Category::find($id);
            if(file_exists(self::$category->image)){
                unlink(self::$category->image);
            }
            self::$category->delete();
    }

    public static function checkStatus($id)
    {
        self::$category= self::find($id);
        if (self::$category->status == 1){
            self::$category->status = 0;
        }
        else{
            self::$category->status = 1;
        }
        self::$category->save();

    }

    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function sub_subcategory()
    {
        return $this->hasMany(SubSubCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class)->where('status', 1);
    }
}