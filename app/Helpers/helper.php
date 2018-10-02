<?php

if (!function_exists('storageSum'))
{
    function storageSum()
    {
        $storageSum = App\Post::where('user_id', Auth()->user()->id)->sum('size_bytes');
        return $storageSum;
    }
}

if (!function_exists('storagePercentage'))
{
    function storagePercentage()
    {
        $storageSum = App\Post::where('user_id', Auth()->user()->id)->sum('size_bytes');
        $percent = ($storageSum/5368709120)*100;
        $percent = round($percent, 2);

        return $percent;
    }
}

if (!function_exists('totalStorageUse'))
{
    function totalStorageUse()
    {
        $storageSum = App\Post::where('user_id', Auth()->user()->id)->sum('size_bytes');
        $storageUsed = sizeConvert($storageSum);

        if ($storageSum < 1) {
            $storageUsed = 'NA';
        }

        return $storageUsed;
    }
}

if (!function_exists('storageRemaining'))
{
    function storageRemaining()
    {
        $storageSum = App\Post::where('user_id', Auth()->user()->id)->sum('size_bytes');
        $remaining = (5368709120 - $storageSum);
        $remaining = sizeConvert($remaining);

        return $remaining;
    }
}

if (!function_exists('totalFileUpload'))
{
    function totalFileUpload()
    {
        $posts = App\Post::where('user_id', Auth()->user()->id)->get();
        $postsCount = count($posts);

        return $postsCount;
    }
}

if (!function_exists('sizeConvert'))
{
    function sizeConvert($bytes, $precision = 2)
    {
        for ($i = 0; ($bytes / 1024) > 0.9; $i++, $bytes /= 1024) {}
            
        return round($bytes, $precision).' '.['B','kB','MB','GB','TB','PB','EB','ZB','YB'][$i];
    }
}
