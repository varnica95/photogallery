<?php


namespace App\Maps;


use App\Models\Gallery;
use App\Models\User;

class ForeignKeyMap
{
    /**
     * @var string[]
     */
    protected static $map = [
        User::class => 'user_id'
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