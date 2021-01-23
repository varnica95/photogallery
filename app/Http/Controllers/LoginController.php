<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;
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

        $user = User::login($data);

        if (is_null($user)){
            $this->view('login.index', [
                'errors' => [ 'Username does not exist.' ]
            ]);

            die();
        }

        if (! $user){
            $this->view('login.index', [
                'errors' => [ 'The password you entered is not correct.' ]
            ]);

            die();
        }

        $request->setSession('id', $user->id);
        $request->redirect('home');
    }

    /**
     * @param Request $request
     */
    public function out(Request $request)
    {
        if ($request->user()){
            $request->destroySession();
            $request->redirect('home');
        }

        $request->redirect('login');
    }
}