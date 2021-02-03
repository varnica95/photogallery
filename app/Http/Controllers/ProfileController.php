<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;
use App\Core\Includes\Config;
use App\Core\Includes\Cookie;
use App\Core\Includes\Hash;
use App\Core\Includes\Session;
use App\Core\Model;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * @param Request $request
     * @param User $user
     */
    public function show(Request $request, User $user)
    {
        $this->view('profile.show', compact('user'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required|is_users_password|different_than:new_password',
            'new_password' => 'required|same_as:new_password_again',
            'new_password_again' => 'required'
        ]);

        User::update([
            'password' => Hash::make($request->new_password)
        ], $request->user()->id);

        $user = $request->user();

        $this->view('profile.show', [
            'user' => $user,
            'success' => 'Password changed successfully'
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     */
    public function destroy(Request $request, User $user)
    {
        if (User::delete($user->id)){

            Model::deleteHash($user->id);
            Cookie::unset(Config::env('cookie.name'));

            $request->destroySession();
            $request->redirect('home');
        }

        $this->view('profile.show', [
            'user' => $user
        ]);
    }
}