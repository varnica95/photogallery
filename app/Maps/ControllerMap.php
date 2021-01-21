<?php


namespace App\Maps;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;

class ControllerMap
{
    protected static $map = [
        'home' => HomeController::class,
        'register' => RegisterController::class,
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