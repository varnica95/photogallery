<?php


namespace App\Core;


class Controller
{
    public function view($path, array $parameters = [])
    {
        View::render($path, $parameters);
    }
}