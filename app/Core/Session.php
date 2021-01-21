<?php


namespace App\Core;


class Session
{
    /**
     *
     */
    public static function start()
    {
        if (! isset($_SESSION)){
            session_start();
        }
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public static function get($name)
    {
        return self::has($name) ? $_SESSION[$name] : null;
    }

    /**
     * @param $name
     * @param $value
     */
    public static function set($name, $value)
    {
        if (self::has($name)){
            return;
        }
        $_SESSION[$name] = $value;
    }

    /**
     *
     */
    public static function destroy()
    {
        if (isset($_SESSION)){
            session_unset();

            session_destroy();
        }
    }

    /**
     * @param $name
     * @return bool
     */
    private static function has($name)
    {
        return isset($_SESSION[$name]);
    }
}