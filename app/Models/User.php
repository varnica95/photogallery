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

    /**
     * @return mixed
     */
    public function images()
    {
        return $this->hasManyThrough(Gallery::class, Image::class);
    }
}