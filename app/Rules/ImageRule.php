<?php


namespace App\Rules;


use App\Core\Validation\Rule;

class ImageRule extends Rule
{
    /**
     * @var string[]
     */
    protected $allowedTypes = [
        'image/png', 'image/jpeg', 'image/jpg', 'image/gif', 'image/png'
    ];



    /**
     * @param $field
     * @param $value
     * @param $data
     * @return bool
     */
    public function passes($field, $value, $data)
    {
        $exploded = explode('.', $field);
        $key = end($exploded);

        if (($key === 'size') && $value === 0) {
            return true;
        }

        if (($key === 'type') && !in_array($value, $this->allowedTypes, true)) {
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
        return $field . ' is not a valid image.';
    }
}