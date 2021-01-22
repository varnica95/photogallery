<?php


namespace App\Bags;


class FileBag
{
    protected $files = [];

    public function __construct($files)
    {
        dump($this->arrangeFileArrays($files));
    }

    protected function arrangeFileArrays($files)
    {
        $results = [];

        foreach ($files as $name => $data) {
            foreach ($data as $key => $value) {
                if (is_array($value)){
                    foreach ($value as $i => $v) {
                        $results[$i][$key] = $v;
                    }
                }else{
                    $results[] = $data;
                    break;
                }
            }
        }
        return $results;
    }
}