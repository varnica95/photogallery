<?php


namespace App\Rules;


use App\Core\Validation\Rule;

class MaxRule extends Rule
{
    /**
     * @var
     */
    protected $max;

    /**
     * MaxRule constructor.
     * @param int $max
     */
    public function __construct(int $max)
    {
        $this->max = $max;
    }

    /**
     * @param $field
     * @param $value
     * @param $data
     * @return bool
     */
    public function passes($field, $value, $data)
    {
        return strlen($value) <= $this->max;
    }

    public function message($field)
    {
        return $field . ' must be a max of ' . $this->max . ' characters.';
    }
}