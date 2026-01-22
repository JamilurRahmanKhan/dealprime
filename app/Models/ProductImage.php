<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;
class ProductImage extends Model
{
    use HasFactory;

    private static $productImage, $productImages, $image,$imageName,$extension, $directory;

    private static function getImageUrl($image)
    {
        self::$extension = $image->getClientOriginalExtension(); 
        self::$imageName = Str::uuid() . '_spinner-img_' . time() . '_' . str_replace('.', '', microtime(true)) . '.' . self::$extension;
        self::$directory = "adminAsset/img/product-other-img/";
        $image->move(self::$directory, self::$imageName);

        return self::$directory . self::$imageName;
    }
 

    public static function newProductImage($images,$id){
        
        // ini_set('max_file_uploads','50');
        // $uploadMaxFilesize = ini_get('upload_max_filesize');
    
        // // Output the current value
        // dd( "Current upload_max_filesize is: " . $uploadMaxFilesize);
    
        // // Check if the value is 50M (50 Megabytes)
        // if ($uploadMaxFilesize === '50M') {
        //     dd( "The upload_max_filesize is set to 50MB.");
        // } else {
        //     dd( "The upload_max_filesize is not set to 50MB. It is currently set to: " . $uploadMaxFilesize);
        // }
 
        foreach ($images as $image){
             if (!isset($image)) continue;
            self::$productImage = new ProductImage();
            self::$productImage->product_id = $id;
            self::$productImage->image = self::getImageUrl($image);
            self::$productImage->save();
        }
    }

    public static function updateProductImage($images, $id){
          
        self::$productImages = ProductImage::where('product_id',$id)->get();
        foreach (self::$productImages as $productImage ){

            if (file_exists($productImage->image)){
                unlink($productImage->image);
            }

            $productImage->delete();
        }

        self::newProductImage($images, $id);
        
        
        // $productImages = ProductImage::where('product_id', $id)->get();

        // foreach ($productImages as $productImage) {
        //     if (file_exists(public_path($productImage->image))) { 
        //         @unlink(public_path($productImage->image)); 
        //     }
        //     $productImage->delete();
        // }
        
        // // নতুন ইমেজ আপলোড করার সময় ইউনিক নাম ব্যবহার করা
        // self::newProductImage($images, $id);
        
        
        
    }
}