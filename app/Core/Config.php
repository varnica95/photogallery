<?php


namespace App\Core;


class Config
{
    protected static $file;

    protected static function getFile()
    {
        $filePath = __DIR__ . '/../../env.php';

        if (! self::exists($filePath)){
            dump('env not found');
            die();
        }

        return self::$file = include $filePath;
    }

    public static function env(string $path)
    {
        $exploded = explode('.', $path);
        $temporary = self::getFile();

        foreach ($exploded as $part){
            if (isset($temporary[$part])){
                $temporary = $temporary[$part];
            }
        }

        return $temporary;
    }

    /**
     * @param $path
     * @return bool
     */
    protected static function exists($path)
    {
        return is_readable($path);
    }
}