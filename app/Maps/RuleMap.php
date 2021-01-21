<?php


namespace App\Maps;


use App\Rules\BetweenRule;
use App\Rules\EmailRule;
use App\Rules\MaxRule;
use App\Rules\MinRule;
use App\Rules\RequiredRule;

class RuleMap
{
    /**
     * @var string[]
     */
    protected static $map = [
        'required' => RequiredRule::class,
        'email' => EmailRule::class,
        'min' => MinRule::class,
        'max' => MaxRule::class,
        'between' => BetweenRule::class
    ];

    public static function resolve($rule, $options)
    {
        return new self::$map[$rule](...$options);
    }
}