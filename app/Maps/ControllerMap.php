<?php


namespace App\Maps;


use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

class ControllerMap
{
    protected static $map = [
        'home' => HomeController::class,
        'register' => RegisterController::class,
        'login' => LoginController::class,
        'gallery' => GalleryController::class,
    ];

    public static function resolve($class)
    {
        foreach (self::$map as $key => $value) {
            if ($value === $class){
                return $key;
            }
        }
    }
}