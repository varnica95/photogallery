<?php


namespace App\Core\Validation;


use App\Bags\ErrorBag;
use App\Maps\RuleMap;
use App\Rules\OptionalRule;

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
     * @var array
     */
    protected $aliases = [];

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

    /**
     * @param array $aliases
     */
    public function setAliases(array $aliases)
    {
        $this->aliases = $aliases;
    }

    /**
     * @return bool
     */
    public function validate()
    {
        foreach ($this->rules as $field => $rules) {
            $resolved = $this->resolveRules($this->extractRulesFromString($rules));

            foreach ($resolved as $rule) {
                $this->validateRule($field, $rule, $this->resolvedRulesContainOptional($resolved));
            }
        }

        return ! $this->errors->has();
    }

    protected function resolvedRulesContainOptional(array $rules)
    {
        foreach ($rules as $rule) {
            if ($rule instanceof OptionalRule){
                return true;
            }
        }

        return false;
    }

    private function validateRule($field, Rule $rule, bool $optional = false)
    {
        if (empty($value = $this->getValueFrom($this->data, $field)) && $optional){
            return;
        }

        if (! $rule->passes($field, $value, $this->data))
        {
            $this->errors->add($field, $rule->message($this->alias($field)));
        }
    }

    private function alias($field)
    {
        return $this->aliases[$field] ?? $field;
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
                return $this->extractRuleFromString($rule);
            }

            return $rule;
        }, $rules);
    }

    /**
     * @param string $rule
     * @return mixed|null
     */
    private function extractRuleFromString(string $rule)
    {
        return $this->extractRuleFromMap(
            ($exploded = explode(':', $rule))[0],
            explode(',', end($exploded))
        );
    }

    /**
     * @param $rule
     * @param $options
     * @return mixed
     */
    private function extractRuleFromMap($rule, $options)
    {
        return RuleMap::resolve($rule, $options);
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