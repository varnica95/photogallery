<?php


namespace App\Traits\App;


trait MethodAccessor
{
    public function get($route, $handler)
    {
        $this->item('router')->setRoute($route, $handler, ['GET']);
        return $this;
    }

    public function post($route, $handler)
    {
        $this->item('router')->setRoute($route, $handler, ['POST']);
        return $this;
    }

    public function delete($route, $handler)
    {
        $this->item('router')->setRoute($route, $handler, ['DELETE']);
        return $this;
    }
}