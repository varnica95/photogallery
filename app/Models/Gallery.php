<?php


namespace App\Models;


use App\Core\Includes\Config;
use App\Core\Includes\Hash;
use App\Core\Model;

class Gallery extends Model
{

    /**
     * @return string
     */
    public function defaultImage()
    {
        return Config::env('storage.gallery_images') . 'gallery_image.png';
    }

    /**
     *
     */
    public function save()
    {
        self::update(get_object_vars($this), $this->id);
    }

    public function uploadGalleryImage()
    {
        $extension = explode('.', $this->image['name'])[1];
        $image = Hash::unique($this->image['name']) . '.' . $extension;

        $path = Config::env('storage.gallery_images') . $image;

        if(! move_uploaded_file($this->image['tmp_name'], $path)){
            return false;
        }

        self::update([
            'image' => $path
        ], $this->id);
    }

    public function user()
    {
        return Model::join(__CLASS__, 'inner', User::class, 'user_id', 'id');
    }

    public function destroy()
    {
        self::delete($this->id);
    }
}