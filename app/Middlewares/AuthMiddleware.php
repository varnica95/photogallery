<?php

namespace App\Middlewares;

use App\Core\Http\Request;

class AuthMiddleware
{
    public function __invoke(Request $request, callable $next, $route)
    {
        $path = $_SERVER['PATH_INFO'] ?? '/home';

        if (empty($request->getSession('id')) && ($path === $route)) {
            $request->setSession('id', 'dummy');
            $request->redirect('login');
        }

        return $next($request);
    }
}