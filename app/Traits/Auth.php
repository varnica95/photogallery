<?php


namespace App\Traits;


use App\Core\Includes\Config;
use App\Core\Includes\Cookie;
use App\Core\Includes\Hash;
use App\Core\Model;
use App\Core\View;


trait Auth
{
    /**
     * @param array $data
     * @return false|mixed|null
     */
    public static function login(array $data, $remember = null)
    {
        $user = self::get('*', 'users', 'username', $data['username']);

        if (empty($user)){
            View::render('login.index', [
                'errors' => [ 'Username does not exist.' ]
            ]);

            return null;
        }

        if (! Hash::check($data['password'], $user->password)){
            View::render('login.index', [
                'errors' => [ 'The password you entered is not correct.' ]
            ]);

            return null;
        }

        if (! is_null($remember)){
            $cookie = Model::getHash($user->id);

            if(! $cookie){
                $hash = Hash::unique();
                $cookie = Model::createHash([
                    'user_id' => $user->id,
                    'hash' => $hash
                ]);
            }

            Cookie::set(Config::env('cookie.name'), $cookie->hash, Config::env('cookie.expiracy'));
        }

        unset($user->password);

        return $user;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public static function register(array $data)
    {
        return self::create($data);
    }
}