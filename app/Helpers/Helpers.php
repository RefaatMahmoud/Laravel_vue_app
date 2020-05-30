<?php

if (!function_exists('uploadFile')) {
    function uploadFile($file, $directory)
    {
        $file_name = time() . $file->getClientOriginalName();
        $file->storeAs($directory, $file_name);
        return $file_name;
    }
}
