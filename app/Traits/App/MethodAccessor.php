<?php


namespace App\Traits\App;


trait MethodAccessor
{
    /**
     * @param $route
     * @param $handler
     * @return $this
     */
    public function get($route, $handler)
    {
        $this->item('router')->setRoute($route, $handler, ['GET']);
        return $this;
    }

    /**
     * @param $route
     * @param $handler
     * @return $this
     */
    public function post($route, $handler)
    {
        $this->item('router')->setRoute($route, $handler, ['POST']);
        return $this;
    }

    /**
     * @param $route
     * @param $handler
     * @return $this
     */
    public function delete($route, $handler)
    {
        $this->item('router')->setRoute($route, $handler, ['DELETE']);
        return $this;
    }

    /**
     * @param $route
     * @param $handler
     * @return $this
     */
    public function put($route, $handler)
    {
        $this->item('router')->setRoute($route, $handler, ['PUT']);
        return $this;
    }
}