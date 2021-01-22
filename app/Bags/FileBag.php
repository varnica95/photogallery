<?php


namespace App\Bags;


class FileBag
{
    /**
     * @var array
     */
    protected $files = [];

    /**
     * FileBag constructor.
     * @param $files
     */
    public function __construct($files)
    {
        $this->files = $this->areFilesEmpty($this->arrangeFileArrays($files));
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param $files
     * @return array
     */
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

    /**
     * @param $arranged
     * @return array
     */
    protected function areFilesEmpty($arranged)
    {
        if (count($arranged) === 1 && $arranged[0]['size'] === 0){
            return [];
        }
        return $arranged;
    }
}