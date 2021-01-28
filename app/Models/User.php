<?php


namespace App\Models;


use App\Core\Model;
use App\Traits\Auth;

class User extends Model
{
    use Auth;

    /**
     * @return array
     */
    public function galleries()
    {
        return self::join(Gallery::class, 'INNER', __CLASS__, 'user_id', 'id', $this->id);
    }

    public function images()
    {
        return self::joinThrough(
            Gallery::class, Image::class, __CLASS__,
                'INNER', 'INNER',
                    'gallery_id', 'id', 'user_id', 'id');
    }
}