<?php

namespace App\Traits\Routing;

trait RouteMatcher
{
    /**
     * @param $routes
     * @param $path
     * @return false|mixed
     */
    public function match($routes, $path)
    {
        foreach (array_keys($routes) as $route){
            $regex = preg_replace('/\//', '\\/', $route);
            $regex = preg_replace('/{(.*?)}/', '(?P<\1>[^\.]+)', $regex);

            if (preg_match('/^' . $regex . '/', $path, $matched)){
                self::$matchedRoutes[$route] = $matched[0];

                $this->extractParametersFrom($matched);

                return $route;
            }
        }

        return false;
    }

    /**
     * @param $matched
     */
    protected function extractParametersFrom($matched)
    {
        foreach ($matched as $key => $value){
            if (is_string($key)) {
                $this->parameters[$key] = $value;
            }
        }
    }
}