<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;
use App\Models\User;

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
        $data = $request->validate([
            'first_name' => 'required|name',
            'last_name' => 'required|name',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|same_as:password_again',
            'password_again' => 'required',
        ]);

        $user = User::create($data);
    }
}