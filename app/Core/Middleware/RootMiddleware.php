<?php


namespace App\Core\Middleware;


class RootMiddleware
{
    /**
     * @var \Closure
     */
    protected $root;

    public function __construct()
    {
        $this->root = function (){
          dump('root');
        };
    }

    public function add(Middleware $middleware)
    {

    }

    public function handle()
    {

    }
}