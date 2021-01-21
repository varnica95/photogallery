<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;

class RegisterController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $this->view('register.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);
    }
}