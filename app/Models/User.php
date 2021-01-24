<?php


namespace App\Models;


use App\Core\Includes\Hash;
use App\Core\Model;

class User extends Model
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

    /**
     * @return array
     */
    public function galleries()
    {
        return self::join(__CLASS__, 'INNER', Gallery::class, 'id', 'user_id');
    }
}