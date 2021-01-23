<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;
use App\Core\Includes\Hash;
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

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|name',
            'last_name' => 'required|name',
            'username' => 'required|name|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|same_as:password_again',
            'password_again' => 'required',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (isset($user)) {
            $request->setSession('id', $user->id);
            $request->redirect('home');
        }
    }
}