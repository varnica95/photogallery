<?php

namespace App\Traits;


use App\Core\Model;
use App\Maps\ForeignKeyMap;
use App\Maps\LocalKeyMap;

trait HasRelation
{
    public function hasMany($class)
    {
        $localKey = LocalKeyMap::resolve($class);

        return Model::join(
            $class, 'INNER', __CLASS__,
            $localKey, 'id',
            $this->id);
    }

    /**
     * @param $class
     * @return array
     */
    public function belongsTo($class)
    {
        $foreignKey =  ForeignKeyMap::resolve($class);

        return Model::joinOne(
            $class, 'INNER', __CLASS__,
            'id', $foreignKey,
            $this->$foreignKey);
    }
}