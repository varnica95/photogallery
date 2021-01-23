<?php


namespace App\Core;


class Container
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * @var array
     */
    protected $cache = [];

    /**
     * Container constructor.
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @param $name
     * @return false|mixed
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * @param $name
     * @return false|mixed
     */
    protected function get($name)
    {
        if (! $this->exists($name))
        {
            return false;
        }

        if (isset($this->cache[$name]))
        {
            return $this->cache[$name];
        }

        $item = $this->items[$name]($this);
        $this->cache[$name] = $item;

        return $item;
    }

    /**
     * @param $name
     * @return bool
     */
    protected function exists($name)
    {
        return isset($this->items[$name]);
    }
}