<?php


namespace App\Rules;


use App\Core\Validation\Rule;

class RequiredRule extends Rule
{
    /**
     * @param $field
     * @param $value
     * @param $data
     * @return bool
     */
    public function passes($field, $value, $data)
    {
        return ! empty($value);
    }

    /**
     * @param $field
     * @return string
     */
    public function message($field)
    {
        return $field . ' is required.';
    }
}