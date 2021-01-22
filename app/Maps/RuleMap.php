<?php


namespace App\Maps;


use App\Rules\BetweenRule;
use App\Rules\EmailRule;
use App\Rules\MaxRule;
use App\Rules\MinRule;
use App\Rules\NameRule;
use App\Rules\OptionalRule;
use App\Rules\RequiredRule;
use App\Rules\SameAsRule;
use App\Rules\UniqueRule;

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
        'between' => BetweenRule::class,
        'name' => NameRule::class,
        'same_as' => SameAsRule::class,
        'unique' => UniqueRule::class,
        'optional' => OptionalRule::class,
    ];

    public static function resolve($rule, $options)
    {
        return new self::$map[$rule](...$options);
    }
}