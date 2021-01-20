<?php

namespace App\Http\Controllers;

use App\Core\Http\Request;

class HomeController
{
    public function index(Request $request)
    {
        return 'inside';
    }
}