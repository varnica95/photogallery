<?php


namespace App\Traits;


use App\Core\Includes\Hash;

trait Auth
{
    /**
     * @param array $data
     * @return false|mixed|null
     */
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