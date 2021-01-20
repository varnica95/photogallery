<?php


namespace App\Core;


use App\Core\Routing\Router;
use App\Traits\RouteAccessor;

class App
{
    use RouteAccessor;

    /**
     * @var Container
     */
    protected $container;

    /**
     * App constructor.
     */
    public function __construct()
    {
        $this->container = new Container([
            'router' => function(){
                return new Router();
            }
        ]);
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }
}