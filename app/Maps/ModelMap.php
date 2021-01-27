<?php


namespace App\Maps;


use App\Models\Gallery;
use App\Models\Image;
use App\Models\User;

class ModelMap
{
    /**
     * @var string[]
     */
    protected static $map = [
        'user' => User::class,
        'gallery' => Gallery::class,
        'image' => Image::class
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