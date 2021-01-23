<?php


namespace App\Models;


use App\Core\Includes\Config;
use App\Core\Model;

class Gallery extends Model
{
    /**
     * @return string
     */
    public function defaultImage()
    {
        return Config::env('storage.galleries') . 'gallery_image.png';
    }
}