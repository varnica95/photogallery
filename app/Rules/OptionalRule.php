<?php


namespace App\Rules;


use App\Core\Validation\Rule;

class OptionalRule extends Rule
{
    /**
     * @param $field
     * @param $value
     * @param $data
     * @return false|int|mixed
     */
    public function passes($field, $value, $data)
    {
        return true;
    }

    /**
     * @param $field
     * @return string
     */
    public function message($field)
    {
        return '';
    }
}