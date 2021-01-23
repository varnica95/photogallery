<?php


namespace App\Maps;


use App\Models\Gallery;
use App\Models\User;

class TableMap
{
    /**
     * @var string[]
     */
    protected static $map = [
        'users' => User::class,
        'galleries' => Gallery::class
    ];

    /**
     * @param $class
     * @return string
     */
    public static function resolve($class)
    {
        foreach (self::$map as $key => $value) {
            if ($class === $value){
                return $key;
            }
        }
    }

    /**
     * @param $table
     * @return string|null
     */
    public static function getClass($table)
    {
        return self::$map[$table] ?? null;
    }
}