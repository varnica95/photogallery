<?php


namespace App\Maps;


use App\Models\Gallery;
use App\Models\Image;

class LocalKeyMap
{
    /**
     * @var string[]
     */
    protected static $map = [
        Image::class => 'gallery_id',
        Gallery::class => 'user_id',
    ];

    /**
     * @param $class
     * @return false|string
     */
    public static function resolve($class)
    {
        foreach (self::$map as $key => $value) {
            if ($class === $key){
                return $value;
            }
        }

        return false;
    }
}