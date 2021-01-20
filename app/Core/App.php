<?php


namespace App\Core;


use App\Core\Http\Request;
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
            },
            'request' => function($container){
                return new Request($container);
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

    /**
     *
     */
    public function run()
    {
        $router = $this->getContainer()->router;
        $router->setPath($_SERVER['PATH_INFO'] ?? '/home');

        $response = $router->response();

        return $this->respond($this->process($response));
    }

    /**
     * @param $handler
     * @return false|mixed
     */
    protected function process($handler)
    {
        if (is_array($handler))
        {
            if (! is_object($handler[0])) {
                $handler[0] = new $handler[0];
            }

            return call_user_func($handler, $this->item('request'));
        }

        return $handler();
    }

    /**
     * @param $handler
     */
    protected function respond($handler)
    {
        echo $handler;
        return;
    }
}