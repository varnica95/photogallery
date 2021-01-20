<?php

namespace App\Traits\Routing;

trait RouteMatch
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
        array_shift($matched);

        foreach ($matched as $key => $value){
            if (is_string($key)) {
                $this->parameters[$key] = $value;
            }
        }
    }
}