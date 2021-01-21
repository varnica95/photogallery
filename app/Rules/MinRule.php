<?php


namespace App\Rules;


use App\Core\Validation\Rule;

class MinRule extends Rule
{
    /**
     * @var
     */
    protected $min;

    /**
     * MinRule constructor.
     * @param int $min
     */
    public function __construct(int $min)
    {
        $this->min = $min;
    }

    /**
     * @param $field
     * @param $value
     * @param $data
     * @return bool
     */
    public function passes($field, $value, $data)
    {
        return $this->min <= strlen($value);
    }

    public function message($field)
    {
        return $field . ' must be a min of ' . $this->min . ' characters.';
    }
}