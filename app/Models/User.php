<?php


namespace App\Models;


use App\Core\Includes\Hash;
use App\Core\Model;

class User extends Model
{
    public static function login(array $data)
    {
        $user = self::get('*', 'users', 'username', $data['username']);

        if (empty($user)){
            return null;
        }

        if (! Hash::check($data['password'], $user->password)){
            return false;
        }

        unset($user->password);

        return $user;
    }
}