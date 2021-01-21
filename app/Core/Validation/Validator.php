<?php


namespace App\Core\Validation;


class Validator
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * Validator constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}