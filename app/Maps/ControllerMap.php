<?php


namespace App\Maps;


use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

class ControllerMap
{
    protected static $map = [
        'home.index' => HomeController::class,
        'register.index' => RegisterController::class,
        'login.index' => LoginController::class,
        'galleries.create' => GalleryController::class,
        'images.upload' => ImageController::class
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