<?php


namespace App\Models;


use App\Core\Model;
use App\Maps\TableMap;

class User extends Model
{
    public static function login(array $data)
    {
        $user = self::get('*', 'users', 'username', $data['username']);

        if (empty($user)){
            return null;
        }

        if (! password_verify($data['password'], $user->password)){
            return false;
        }

        unset($user->password);

        return $user;
    }
}