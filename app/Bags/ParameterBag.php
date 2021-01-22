<?php


namespace App\Bags;


class ParameterBag
{
    /**
     * @var array
     */
    protected $postParameters = [];

    /**
     * @var array
     */
    protected $routeParameters = [];

    /**
     * ParameterBag constructor.
     * @param $post
     * @param $route
     */
    public function __construct($post, $files, $route)
    {
        $this->postParameters = $post;

        if (! empty($files)){
            $this->postParameters['images'] = $files;
        }

        $this->routeParameters = $route;
    }

    /**
     * @return array
     */
    public function getPostParameters()
    {
        return $this->postParameters;
    }

    /**
     * @return array
     */
    public function getRouteParameters()
    {
        return $this->routeParameters;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function get($name)
    {
        return $this->has($name) ? $this->postParameters[$name] : null;
    }

    /**
     * @param $name
     * @return bool
     */
    protected function has($name)
    {
        return isset($this->postParameters[$name]);
    }
}