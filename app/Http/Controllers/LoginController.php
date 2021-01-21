<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request)
    {
       $this->view('login.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
           'username' => 'required|name',
           'password' => 'required|min:5',
        ]);

        $user = User::login($data);

        if (is_null($user)){
            $this->view('login.index', [
                'error' => 'Username does not exist.'
            ]);
        }

        if (! $user){
            $this->view('login.index', [
                'error' => 'The password you entered is not correct.'
            ]);
        }
    }
}