<?php


namespace App\Bags;


class FileBag
{
    /**
     * @var
     */
    protected $files;

    public function __construct($files)
    {
        $this->files = $files;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function get($name)
    {
        return $this->exists($name) ? $this->files[$name] : null;
    }

    /**
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param $name
     * @return bool
     */
    protected function exists($name)
    {
        return isset($this->files[$name]);
    }
}