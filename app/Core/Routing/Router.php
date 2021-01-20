<?php

namespace App\Core\Routing;

class Router
{
    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @var
     */
    protected $path;

    /**
     * @var
     */
    protected $methods;

    /**
     * @var
     */
    protected $parameters;

    /**
     * @param $route
     * @param $handler
     * @param $methods
     */
    public function setRoute($route, $handler, $methods)
    {
        $this->routes[$route] = $handler;
        $this->methods[$route] = $methods;
    }

    /**
     * @param string $path
     */
    public function setPath($path = '/')
    {
        $this->path = $path;
    }

    public function response()
    {
        return $this->routes[$this->path];
    }
}