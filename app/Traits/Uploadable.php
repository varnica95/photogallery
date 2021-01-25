<?php


namespace App\Traits;


use App\Core\Includes\Config;
use App\Core\Includes\Hash;

trait Uploadable
{
    /**
     * @return false
     * sudo chmod -R 777 public/storage
     */
    public function uploadTo(string $path)
    {
        $extension = explode('.', $this->image['name'])[1];
        $image = Hash::unique($this->image['name']) . '.' . $extension;

        $path = Config::env('storage.' . $path) . $image;

        if(! move_uploaded_file($this->image['tmp_name'], $path)){
            return false;
        }

        self::update([
            'image' => $path
        ], $this->id);
    }
}