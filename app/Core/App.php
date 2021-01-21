<?php


namespace App\Core;


use App\Core\Http\Request;
use App\Core\Middleware\RootMiddleware;
use App\Core\Routing\Router;
use App\Traits\App\MethodAccessor;
use App\Traits\App\MiddlewareHandler;

class App
{
    use MethodAccessor, MiddlewareHandler;

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
            },
            'middleware' => function(){
                return new RootMiddleware();
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
        $router = $this->item('router');
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

            $middleware = $this->item('middleware');
            $request = $middleware->handle($this->item('request'));

            return call_user_func($handler, $request);
        }

        $parameters = array_values($this->item('request')->getRouteParameters());
        return $handler(...$parameters);
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