<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        dump($request->user());
        $this->view('home.index', [
            'user' => $request->user()
        ]);
    }
}