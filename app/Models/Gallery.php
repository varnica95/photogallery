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
        return self::joinOne(User::class, 'inner', __CLASS__, 'id', 'user_id', $this->user_id);
    }

    /**
     * @return array
     */
    public function images()
    {
        return self::join(Image::class, 'inner', __CLASS__, 'gallery_id', 'id', $this->id);
    }
}