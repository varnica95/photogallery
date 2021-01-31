<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;
use App\Core\Includes\Config;
use App\Core\Includes\Cookie;
use App\Core\Model;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
       $this->view('login.index');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $data = $request->validate([
           'username' => 'required|name',
           'password' => 'required',
        ]);

        $user = User::login($data, $request->only('remember'));

        if (! is_null($user)){
        $request->setSession('id', $user->id);
        $request->redirect('home');
        }
    }

    /**
     * @param Request $request
     */
    public function out(Request $request)
    {
        if ($user = $request->user()){
            Model::deleteHash($user->id);
            Cookie::unset(Config::env('cookie.name'));

            $request->destroySession();
            $request->redirect('home');
        }

        $request->redirect('login');
    }
}