<?php


namespace App\Core;


class Container
{
    protected $items = [];

    public function __construct(array $items)
    {
        $this->items = $items;
    }
}