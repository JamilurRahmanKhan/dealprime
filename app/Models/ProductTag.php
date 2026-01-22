<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;
    private static $productTag, $productTags;

    public static function newProductTag($tags, $id){
        foreach ($tags as $tag){
            self::$productTag = new ProductTag();
            self::$productTag->product_id = $id;
            self::$productTag->tag_id = $tag;
            self::$productTag->save();
        }
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public static function updateProductTag($tags, $id)
    {

        self::$productTags = ProductTag::where('product_id', $id)->get();
        foreach (self::$productTags as $productTag) {
            $productTag->delete();
        }

        self::newProductTag($tags, $id);
    }
}