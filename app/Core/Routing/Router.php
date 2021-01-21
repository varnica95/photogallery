<?php

namespace App\Core\Routing;

use App\Traits\Routing\RouteMatcher;

class Router
{
    use RouteMatcher;

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
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }

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
        if (! $route = $this->match($this->routes, $this->path)) {
            dd('404');
        }

        if (! in_array($_SERVER['REQUEST_METHOD'], $this->methods[$route])) {
            dd('Unauthorized');
        }

        return $this->routes[$route];
    }
}