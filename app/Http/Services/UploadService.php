<?php

namespace App\Http\Services;

class UploadService{

    public static function upload($file, $prefix){

        if(!isset($file)) return null;
        
        $fileName = $prefix . '_' . $file->hashName();

        $filePath = $file->storeAs('images/' . $prefix, $fileName);

        return $filePath;
    }

}