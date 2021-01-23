<?php


namespace App\Rules;


use App\Core\Validation\Rule;

class BetweenRule extends Rule
{
    /**
     * @var
     */
    protected $lower;

    /**
     * @var
     */
    protected $upper;

    /**
     * BetweenRule constructor.
     * @param int $lower
     * @param int $upper
     */
    public function __construct(int $lower, int $upper)
    {
        $this->lower = $lower;
        $this->upper = $upper;
    }

    /**
     * @param $field
     * @param $value
     * @param $data
     * @return bool
     */
    public function passes($field, $value, $data)
    {
        return $this->lower <= strlen($value) && strlen($value) <= $this->upper;
    }

    public function message($field)
    {
        return $field . ' must be between ' . $this->lower . ' and ' . $this->upper . ' characters.';
    }
}