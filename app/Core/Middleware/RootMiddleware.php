<?php


namespace App\Core\Middleware;


use App\Core\Http\Request;

class RootMiddleware
{
    /**
     * @var \Closure
     */
    protected $root;

    /**
     * RootMiddleware constructor.
     */
    public function __construct()
    {
        $this->root = function (Request $request){
            return $request;
        };
    }

    /**
     * @param $middleware
     * @param $route
     */
    public function add($middleware, $route)
    {
        $next = $this->root;
        $this->root = function (Request $request) use ($middleware, $next, $route){
            return $middleware($request, $next, $route);
        };
    }

    /**
     * @param Request $request
     * @return false|mixed
     */
    public function handle(Request $request)
    {
        return call_user_func($this->root, $request);
    }
}