<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPostTag extends Model
{
    use HasFactory;
    private static $blogTag, $blogTags;

    public static function newBlogTag($tags, $id){
        foreach ($tags as $tag){
            self::$blogTag = new BlogPostTag();
            self::$blogTag->blog_id = $id;
            self::$blogTag->blog_tag_id = $tag;
            self::$blogTag->save();
        }
    }
    public function blogTag()
    {
        return $this->belongsTo(BlogTag::class);
    }

    public static function updateBlogTag($tags, $id)
    {

        self::$blogTags = BlogPostTag::where('blog_id', $id)->get();
        foreach (self::$blogTags as $blogTag) {
            $blogTag->delete();
        }

        self::newBlogTag($tags, $id);
    }
}