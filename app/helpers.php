<?php
declare(strict_types=1);

if (! function_exists('image_url')) {//image_urlというヘルパー関数定義
    function image_url(string $path): string
    {
        if (app()->environment('production')) {
            return (string) app()->make(\Cloudinary\Cloudinary::class)->image($path)->secure();
        }
        return asset('storage/images/memory/' . $path);
    }
}