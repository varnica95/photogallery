<?php


namespace App\Traits\App;


trait RouteAccessor
{
    public function get($route, $handler)
    {
        $this->item('router')->setRoute($route, $handler, ['GET']);
    }

    public function post($route, $handler)
    {
        $this->item('router')->router->setRoute($route, $handler, ['POST']);
    }
}