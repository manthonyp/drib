<?php

if (!function_exists('sizeConvert'))
{
    function sizeConvert($bytes)
    {
        $units = ['b', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}

if (!function_exists('totalFileUpload'))
{
    function totalFileUpload()
    {
        $posts = App\Post::where('user_id', Auth()->user()->id)->get();
        $postsCount = count($posts);

        if ($postsCount < 1) {
            $postsCount = 'NA';
        }

        return $postsCount;
    }
}

if (!function_exists('totalStorageUse'))
{
    function totalStorageUse()
    {
        $storageSum = App\Post::where('user_id', Auth()->user()->id)->sum('size_bytes');
        $storageUsed = sizeConvert($storageSum);

        if ($storageUsed < 1) {
            $storageUsed = 'NA';
        }

        return $storageUsed;
    }
}