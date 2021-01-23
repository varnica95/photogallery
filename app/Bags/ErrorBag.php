<?php


namespace App\Bags;


class ErrorBag
{
    /**
     * @var
     */
    protected $errors;

    /**
     * @param $field
     * @param $message
     */
    public function add($field, $message)
    {
        $this->errors[] = $message;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return [
            'errors' => $this->errors
        ];
    }

    /**
     * @return bool
     */
    public function has()
    {
        return ! empty($this->errors);
    }
}