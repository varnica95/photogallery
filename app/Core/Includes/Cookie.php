<?php


namespace App\Core\Includes;


class Cookie
{
    /**
     * @param $name
     * @param $value
     * @param $expiracy
     * @return bool
     */
    public static function set($name, $value, $expiracy)
    {
        return self::exists($name) ? false : setcookie($name, $value, time() + $expiracy);
    }

    /**
     * @param $name
     * @return false|mixed
     */
    public static function get($name)
    {
        return self::exists($name) ? $_COOKIE[$name] : false;
    }

    /**
     * @param $name
     * @return bool
     */
    protected static function exists($name)
    {
        return isset($_COOKIE[$name]);
    }
}