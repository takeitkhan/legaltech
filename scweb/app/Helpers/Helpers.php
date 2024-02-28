<?php 
namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class Helpers
{
    public static function uploadImage(UploadedFile $file, $directory = 'images', $disk = 'public')
    {
        $path = $file->store($directory, $disk);
        return $path;
    }
}