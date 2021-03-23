<?php


namespace App;


class Base64_converter
{

    public function base64_to_png($string){
        $image = explode(',', $string);
        $imageName = (string)mt_rand() . '.png';
        return array(base64_decode($image[1]), $imageName);
    }
    public function base64_to_jpg($string){
        $image = explode(',', $string);
        $imageName = (string)mt_rand() . '.jpg';
        return array(base64_decode($image[1]), $imageName);
    }
    public function base64_to_jpeg($string){
        $image = explode(',', $string);
        $imageName = (string)mt_rand() . '.jpeg';
        return array(base64_decode($image[1]), $imageName);
    }
}
