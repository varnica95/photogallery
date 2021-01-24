<?php


namespace App\Maps;


use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Models\Gallery;
use App\Models\User;

class ModelMap
{
    /**
     * @var string[]
     */
    protected static $map = [
        'user' => User::class,
        'gallery' => Gallery::class,
    ];

    /**
     * @param $parameter
     * @return false|string
     */
    public static function resolve($parameter)
    {
        foreach (self::$map as $key => $value) {
            if ($parameter === $key){
                return $value;
            }
        }

        return null;
    }
}