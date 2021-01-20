<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $this->view('home.index');
    }
}