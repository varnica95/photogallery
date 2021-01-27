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
    public function uploadTo(string $dir)
    {
        $extension = explode('.', $this->image['name'])[1];
        $image = Hash::unique($this->image['name']) . '.' . $extension;

        $path = Config::env('storage.' . $dir) . $image;

        if(! move_uploaded_file($this->image['tmp_name'], $path)){
            return false;
        }

        self::update([
            'image' => $path
        ], $this->id);
    }

    /**
     * @return string
     */
    public function defaultImage()
    {
        return Config::env('storage.default') . 'gallery_image.png';
    }

    /**
     *
     */
    public function save()
    {
        self::update(get_object_vars($this), $this->id);
    }

    /**
     * @return bool
     */
    public function destroy()
    {
        if(self::delete($this->id)){
            if ((explode('/', $this->image))[1] === 'default'){
                return true;
            }

            return unlink($this->image);
        }
    }
}