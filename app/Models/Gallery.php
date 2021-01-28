<?php


namespace App\Models;


use App\Core\Model;
use App\Traits\HasRelation;
use App\Traits\Uploadable;

class Gallery extends Model
{
    use Uploadable, HasRelation;

    /**
     * @return array
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return array
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}