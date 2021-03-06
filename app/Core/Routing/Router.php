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
     * @var array
     */
    public static $matchedRoutes = [];

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

    /**
     * @return mixed
     */
    public function getLastInsertedRoute()
    {
        $routes = array_keys($this->routes);
        return end($routes);
    }

    /**
     * @return mixed
     */
    public static function getMatchedRoute($route)
    {
        return self::$matchedRoutes[$route] ?? $route;
    }

    /**
     * @return mixed
     */
    public function response()
    {
        if (! $route = $this->match($this->routes, $this->path)) {
            dd('404');
        }

        return $this->resolve($route, $_SERVER['REQUEST_METHOD']);
    }

    /**
     * @param $route
     * @param $method
     * @return mixed
     */
    protected function resolve($route, $method)
    {
        if ($method === 'POST') {
            $cache = $this->routes[$route];
            $cache[1] = 'store';

            if(in_array('DELETE', $this->methods[$route], true)){
                $cache[1] = 'destroy';
            }

            if(in_array('PUT', $this->methods[$route], true)){
                $cache[1] = 'update';
            }

            return $cache;
        }

        if (! in_array($method, $this->methods[$route])) {
            dd('Unauthorized');
        }

        return $this->routes[$route];
    }
}