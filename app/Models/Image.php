<?php


namespace App\Models;


use App\Core\Includes\Config;
use App\Core\Includes\Hash;
use App\Core\Model;

class Image extends Model
{
    /**
     * @return false
     * sudo chmod -R 777 public/storage
     */
    public function uploadImage()
    {
        $extension = explode('.', $this->image['name'])[1];
        $image = Hash::unique($this->image['name']) . '.' . $extension;

        $path = Config::env('storage.images') . $image;

        if(! move_uploaded_file($this->image['tmp_name'], $path)){
            return false;
        }

        self::update([
            'image' => $path
        ], $this->id);
    }
}