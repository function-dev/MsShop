<?php


namespace App;


use Illuminate\Support\Facades\Storage;

class Base64_converter
{
    public function base64_to_png($string, $diskName){
        $image = explode(',', $string);
        $imageName = (string)mt_rand() . '.png';
        Storage::disk($diskName)->put($imageName, base64_decode($image[1]));
        return $imageName;
    }
    public function base64_to_jpg($string, $diskName){
        $image = explode(',', $string);
        $imageName = (string)mt_rand() . '.jpg';
        Storage::disk($diskName)->put($imageName, base64_decode($image[1]));
        return $imageName;
    }
    public function base64_to_jpeg($string, $diskName){
        $image = explode(',', $string);
        $imageName = (string)mt_rand() . '.jpeg';
        Storage::disk($diskName)->put($imageName, base64_decode($image[1]));
        return $imageName;
    }
}

