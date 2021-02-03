<?php


namespace App\Bags;


class ErrorBag
{
    /**
     * @var
     */
    protected $errors;

    protected $alerts;

    /**
     * @param $field
     * @param $message
     */
    public function add($field, $message)
    {
        $this->errors[] = $message;
        $this->alerts[$field] = '';
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return [
            'errors' => $this->errors,
            'alerts' => $this->alerts
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