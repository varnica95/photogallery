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
        return self::join(__CLASS__, 'INNER', Gallery::class, 'id', 'user_id');
    }
}