<?php


namespace App\Rules;


use App\Core\Validation\Rule;

class ImageRule extends Rule
{
    /**
     * @var string[]
     */
    protected $allowedTypes = [
        'image/png',
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png'
    ];

    /**
     * @param $field
     * @param $value
     * @param $data
     * @return bool
     */
    public function passes($field, $value, $data)
    {
//        if (($file = File::get($field))['size'] === 0){
//            return true;
//        }
//
//        if (! in_array($file['type'], $this->allowedTypes, true)){
//            return false;
//        }

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