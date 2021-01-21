<?php


namespace App\Rules;


use App\Core\Model;
use App\Core\Validation\Rule;

class UniqueRule extends Rule
{
    /**
     * @var
     */
    protected $table;

    /**
     * UniqueRule constructor.
     * @param $field
     */
    public function __construct($table)
    {
        $this->field = $table;
    }

    /**
     * @param $field
     * @param $value
     * @param $data
     * @return bool
     */
    public function passes($field, $value, $data)
    {
        if (Model::validate($field, $this->field, $value)){
            return false;
        }

        return true;
    }

    /**
     * @param $field
     * @return string
     */
    public function message($field)
    {
        return 'This ' . $field . ' already exists in database.';
    }
}