<?php


namespace App\Rules;


use App\Core\Validation\Rule;

class RequiredRule extends Rule
{

    public function passes($field, $value, $data)
    {
        return ! empty($value);
    }

    public function message($field)
    {
        return $field . ' is required.';
    }
}