<?php
namespace App\Helpers\Global;


class UploadImage{

  public static function uploadImage($file,$public_path,$file_name){
        $name = $file_name;
        $file->move($public_path, $name);
        return $name;
    }
}
