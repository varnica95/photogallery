<?php


namespace App\Core;


class View
{
    /**
     * @param $path
     * @param $parameters
     * @return int
     */
    public static function render($path, $parameters = [])
    {
        $path = explode('.', $path);

        if (! is_readable($file = self::file($path))) {
            return 404;
        }

        $documentName = ucfirst($path[0]);
        array_push($parameters, $documentName, $file);

        extract($parameters, EXTR_SKIP);
        require self::root();
    }

    /**
     * @return string
     */
    protected static function root()
    {
        return self::namespace() . '/layouts/app' . self::extension();
    }

    /**
     * @param $path
     * @return string
     */
    protected static function file($path)
    {
        return self::namespace() . implode('/', $path) . self::extension();
    }

    /**
     * @return string
     */
    protected static function namespace()
    {
        return __DIR__ . '/../../resources/views/';
    }

    /**
     * @return string
     */
    protected static function extension()
    {
        return '.phtml';
    }
}