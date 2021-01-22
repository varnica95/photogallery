<?php


namespace App\Traits\App;


use App\Core\Includes\Config;

trait MiddlewareHandler
{
    public function middleware($middleware)
    {
        $route = $this->item('router')->getLastInsertedRoute();

        if (is_object($middleware)){
            $this->item('middleware')->add($middleware, $route);
        }

        if (! $this->exists($middleware = $this->getMiddleware($middleware))){
            return null;
        }
        return $this->item('middleware')->add(new $middleware, $route);
    }

    protected function getMiddleware($middleware)
    {
        return Config::env('middleware.namespace') . ucfirst($middleware) . 'Middleware';
    }

    protected function exists($middleware)
    {
        return class_exists($middleware);
    }
}