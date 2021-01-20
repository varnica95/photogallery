<?php


namespace App\Core;


use App\Core\Routing\Router;
use App\Traits\App\RouteAccessor;

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

    /**
     * @param $name
     * @return false|mixed
     */
    public function item($name)
    {
        return $this->getContainer()->$name;
    }

    public function run()
    {
        $router = $this->getContainer()->router;
        $router->setPath($_SERVER['PATH_INFO'] ?? '/home');

        $response = $router->response();

        return $this->process($response);
    }

    protected function process($handler)
    {
        return $handler();
    }
}