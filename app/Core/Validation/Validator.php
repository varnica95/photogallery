<?php


namespace App\Core\Validation;


use App\Bags\ErrorBag;
use App\Rules\EmailRule;
use App\Rules\RequiredRule;

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

    protected $ruleMap = [
        'required' => RequiredRule::class,
        'email' => EmailRule::class,
    ];

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

    /**
     * @return bool
     */
    public function validate()
    {
        foreach ($this->rules as $field => $rules) {
            $resolved = $this->resolveRules($this->extractRulesFromString($rules));

            foreach ($resolved as $rule) {
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

    /**
     * @param array $rules
     * @return array|null[]
     */
    private function resolveRules(array $rules)
    {
        return array_map(function ($rule){
            if (is_string($rule)){
                return $this->extractRuleFromMap($rule);
            }

            return $rule;
        }, $rules);
    }

    /**
     * @param string $rule
     * @return mixed|null
     */
    private function extractRuleFromMap(string $rule)
    {
        return new $this->ruleMap[$rule] ?? null;
    }

    /**
     * @param $rules
     * @return false|mixed|string[]
     */
    private function extractRulesFromString($rules)
    {
        return is_string($rules) ? explode('|', $rules) : $rules;
    }
}