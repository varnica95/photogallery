<?php


namespace App\Http\Controllers;


use App\Core\Controller;
use App\Core\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(Request $request, User $user)
    {
        $this->view('profile.show', compact('user'));
    }
}