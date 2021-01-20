<?php


namespace App\Core;


class View
{
    public static function render($path, $parameters)
    {
        $path = explode('.', $path);

        if (! is_readable(self::file($path))) {
            return 404;
        }

        require self::root();
    }

    protected static function root()
    {
        return self::namespace() . '/layouts/app' . self::extension();
    }

    protected static function file($path)
    {
        return self::namespace() . implode('/', $path) . self::extension();
    }

    protected static function namespace()
    {
        return __DIR__ . '/../../resources/views/';
    }

    protected static function extension()
    {
        return '.phtml';
    }
}