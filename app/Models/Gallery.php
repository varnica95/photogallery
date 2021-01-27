<?php


namespace App\Models;


use App\Core\Model;
use App\Traits\Uploadable;

class Gallery extends Model
{
    use Uploadable;

    /**
     * @return array
     */
    public function user()
    {
        return self::join(__CLASS__, 'inner', User::class, 'user_id', 'id');
    }

    /**
     * @return array
     */
    public function images()
    {
        return self::join(__CLASS__, 'inner', Image::class, 'id', 'gallery_id');
    }
}