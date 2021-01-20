<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        dump($request->all());
        $this->view('register.index');
    }
}