<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $this->view('register.index');
    }
}