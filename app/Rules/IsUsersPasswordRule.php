<?php


namespace App\Rules;


use App\Core\Includes\Hash;
use App\Core\Model;
use App\Core\Validation\Rule;
use App\Models\User;

class IsUsersPasswordRule extends Rule
{
    /**
     * @param $field
     * @param $value
     * @param $data
     * @return bool
     */
    public function passes($field, $value, $data)
    {
        $user = User::find($data['user_id']);

        if(! Hash::check($value, $user->password)){
           return false;
        }

        return true;
    }

    /**
     * @param $field
     * @return string
     */
    public function message($field)
    {
        return 'The password you entered and the password you registered with are not the same.';
    }
}