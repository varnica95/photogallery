<?php


namespace App\Traits;


trait RouteAccessor
{
    public function get($route, $handler)
    {
        $this->getContainer()->router->setRoute($route, $handler, ['GET']);
    }

    public function post($route, $handler)
    {
        $this->getContainer()->router->setRoute($route, $handler, ['POST']);
    }
}