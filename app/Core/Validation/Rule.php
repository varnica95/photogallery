<?php


namespace App\Core\Validation;


abstract class Rule
{
    /**
     * @param $field
     * @param $value
     * @param $data
     * @return mixed
     */
    abstract public function passes($field, $value, $data);

    /**
     * @param $field
     * @return mixed
     */
    abstract public function message($field);
}