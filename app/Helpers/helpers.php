<?php

use Illuminate\Support\Str;

if (!function_exists('userCan')) {
    function userCan($permission)
    {
        return auth()->user()->can($permission);
    }
}

if (!function_exists('imageUpload')) {
    function imageUpload($image, $directory, $prefix='image')
    {
        $imageName = $prefix.time().Str::camel($image->getClientOriginalName());
        $image->move($directory, $imageName);
        return $directory . $imageName;
    }

}
