<?php

namespace App\Http\Resources;

trait BaseResourceTrait
{

    public function getFilePath()
    {
        return asset('');
        //return asset('public').'/';
    }
}
