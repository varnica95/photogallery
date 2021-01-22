<?php


namespace App\Core\Includes;


class Config
{
    /**
     * @var
     */
    protected static $file;

    /**
     * @return mixed
     */
    protected static function getFile()
    {
        $filePath = __DIR__ . '/../../../env.php';

        if (! self::exists($filePath)){
            dump('env not found');
            die();
        }

        return self::$file = include $filePath;
    }

    /**
     * @param string $path
     * @return mixed
     */
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