<?php


namespace App\Models;


use App\Core\Model;
use App\Traits\Auth;
use App\Traits\HasRelation;

class User extends Model
{
    use Auth, HasRelation;

    /**
     * @return array
     */
    public function galleries()
    {
       return $this->hasMany(Gallery::class);
    }

    public function images()
    {
        return self::joinThrough(
            Gallery::class, Image::class, __CLASS__,
                'INNER', 'INNER',
                    'gallery_id', 'id', 'user_id', 'id');
    }
}