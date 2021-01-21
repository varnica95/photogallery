<?php


namespace App\Core\Validation;


class Validator
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array 
     */
    protected $rules = [];

    /**
     * Validator constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param array $rules
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }

    public function validate()
    {
        
    }
}