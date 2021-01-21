<?php


namespace App\Rules;


use App\Core\Validation\Rule;

class EmailRule extends Rule
{

    /**
     * @param $field
     * @param $value
     * @param $data
     * @return mixed
     */
    public function passes($field, $value, $data)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $field
     * @return string
     */
    public function message($field)
    {
        return $field . ' must be a valid email address.';
    }
}