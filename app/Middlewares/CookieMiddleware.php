<?php

namespace App\Middlewares;

use App\Core\Http\Request;
use App\Core\Includes\Config;
use App\Core\Includes\Cookie;
use App\Core\Model;

class CookieMiddleware
{
    public function __invoke(Request $request, callable $next, $route)
    {
        $path = $_SERVER['PATH_INFO'] ?? '/home';

        if (($path === $route) && ! $_SESSION && $hash = Cookie::get(Config::env('cookie.name'))) {
           $cookie = Model::getHash($hash);

           $request->setSession('id', $cookie->user_id);
           $request->redirect('home');
        }

        return $next($request);
    }
}