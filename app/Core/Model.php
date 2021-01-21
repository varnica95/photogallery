<?php


namespace App\Core;


class Model
{
    protected static $connection;

    protected static function connection()
    {
        return Database::getInstance()->testConnection();
    }

    public static function create(array $data)
    {
        dump(self::$connection = self::connection());
    }
}