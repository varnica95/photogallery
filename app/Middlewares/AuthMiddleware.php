<?php

namespace App\Middlewares;

use App\Core\Http\Request;
use App\Core\Middleware\Middleware;

class AuthMiddleware implements Middleware
{
    public function __invoke(Request $request, callable $next, $route)
    {
        if (empty($request->getSession('id')) && $_SERVER['PATH_INFO'] === $route) {
            $request->setSession('id', 'dummy');
            $request->redirect('login');
        }

        return $next($request);
    }
}