<?php


namespace App\Core\Includes;


class File
{
    /**
     * @param $name
     * @return mixed|null
     */
    public static function get($name)
    {
        return $_FILES[$name];
    }
}