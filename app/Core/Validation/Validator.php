<?php


namespace App\Core\Validation;


use App\Bags\ErrorBag;

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
     * @var ErrorBag
     */
    protected $errors;

    /**
     * Validator constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->errors = new ErrorBag();
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
        foreach ($this->rules as $field => $rules) {
            foreach ($rules as $rule) {
                $this->validateRule($field, $rule);
            }
        }

        return ! $this->errors->has();
    }

    private function validateRule($field, Rule $rule)
    {
        if (! $rule->passes($field, $this->getValueFrom($this->data, $field), $this->data))
        {
            $this->errors->add($field, $rule->message($field));
        }
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors->getErrors();
    }

    /**
     * @param $data
     * @param $field
     * @return mixed|null
     */
    private function getValueFrom($data, $field)
    {
        return $data[$field] ?? null;
    }
}