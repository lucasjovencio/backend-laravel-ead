<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class StorageService
{
    public static function upload($link,$file){
        $link = Storage::disk(config('app.storage.driver'))->put($link,$file);
        Storage::disk(config('app.storage.driver'))->setVisibility($link, config('app.storage.visibility'));
        return $link;
    }

    public static function remove($link){
        Storage::delete($link);
    }

    public static function create($path,$photo)
    {
        return self::upload($path,$photo);
    }
}
