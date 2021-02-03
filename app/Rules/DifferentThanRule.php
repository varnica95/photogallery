<?php


namespace App\Rules;


use App\Core\Validation\Rule;

class DifferentThanRule extends Rule
{
    /**
     * @var
     */
    protected $field;

    /**
     * SameAsRule constructor.
     * @param $field
     */
    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * @param $field
     * @param $value
     * @param $data
     * @return bool
     */
    public function passes($field, $value, $data)
    {
        return $value !== $data[$this->field];
    }

    /**
     * @param $field
     * @return string
     */
    public function message($field)
    {
        return $field . ' must be different than your new password that you typed.';
    }
}