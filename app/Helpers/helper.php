<?php

if (!function_exists('storageSum')) {
    /**
     * Get the sum of used storage in bytes
     *
     * @return void
     */
    function storageSum()
    {
        return App\Post::where('user_id', Auth()->user()->id)->sum('size_bytes');
    }
}

if (!function_exists('totalStorageUse')) {
    /**
     * Get the total storage usage with size suffix
     *
     * @return void
     */
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

if (!function_exists('storagePercentage')) {
    /**
     * Get storage usage percentage
     *
     * @return void
     */
    function storagePercentage()
    {
        $storageSum = App\Post::where('user_id', Auth()->user()->id)->sum('size_bytes');
        $percent = ($storageSum/5368709120)*100;

        return round($percent, 2);
    }
}

if (!function_exists('storageRemaining')) {
    /**
     * Get the remaining storage with size suffix
     *
     * @return void
     */
    function storageRemaining()
    {
        $storageSum = App\Post::where('user_id', Auth()->user()->id)->sum('size_bytes');
        $remaining = (5368709120 - $storageSum);

        return sizeConvert($remaining);
    }
}

if (!function_exists('totalFileUpload')) {
    /**
     * Get user uploaded file count
     *
     * @return void
     */
    function totalFileUpload()
    {
        return App\Post::where('user_id', Auth()->user()->id)->get()->count();
    }
}

if (!function_exists('sizeConvert')) {
    /**
     * Convert bytes to human readable size
     *
     * @param integer $bytes
     * @param integer $precision
     * @return void
     */
    function sizeConvert($bytes, $precision = 2)
    {
        for ($i = 0; ($bytes / 1024) > 0.9; $i++, $bytes /= 1024) {}
            
        return round($bytes, $precision).' '.['B','kB','MB','GB','TB','PB','EB','ZB','YB'][$i];
    }
}
