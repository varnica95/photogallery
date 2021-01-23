<?php


namespace App\Core\Includes;


class Hash
{
    /**
     * @param $string
     * @param string $salt
     * @return string|null
     */
    public static function make($string, $salt = '')
    {
        return crypt($string, $salt);
    }

    /**
     * @param $string
     * @param $hash
     * @return bool
     */
    public static function check($string, $hash)
    {
        return crypt($string, $hash) === $hash;
    }
}