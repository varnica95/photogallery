<?php

namespace App\Http\Controllers;

use App\Core\Controller;
use App\Core\Http\Request;
use App\Models\Gallery;

class HomeController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $this->view('home.index', [
            'user' => $request->user(),
            'galleries' => Gallery::all()
        ]);
    }
}