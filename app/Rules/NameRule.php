<?php


namespace App\Rules;


use App\Core\Validation\Rule;

class NameRule extends Rule
{
    /**
     * @param $field
     * @param $value
     * @param $data
     * @return false|int|mixed
     */
    public function passes($field, $value, $data)
    {
        return ! preg_match('~[0-9]+~', $value);
    }

    /**
     * @param $field
     * @return string
     */
    public function message($field)
    {
        return $field . ' must contain only letters.';
    }
}