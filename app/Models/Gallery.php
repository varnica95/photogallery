<?php


namespace App\Models;


use App\Core\Includes\Config;
use App\Core\Model;
use App\Traits\Uploadable;

class Gallery extends Model
{
    use Uploadable;
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
     * @return array
     */
    public function user()
    {
        return Model::join(__CLASS__, 'inner', User::class, 'user_id', 'id');
    }

    /**
     * @return bool
     */
    public function destroy()
    {
        if(self::delete($this->id)){
            return unlink($this->image);
        }
    }
}