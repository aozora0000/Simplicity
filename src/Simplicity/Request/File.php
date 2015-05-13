<?php
namespace Simplicity\Request;
use \Closure,
    \ArrayObject;
class File
{
    protected $files;

    public function __construct()
    {
        $this->files = $_FILES;
    }

    public function is_uploaded()
    {
        return (!is_null($this->files));
    }

    public function is_success($name)
    {
        return (
            isset($this->files[$name]) &&
            ($this->files[$name]["error"] === UPLOAD_ERR_OK) &&
            is_file($this->files[$name]["tmp_name"])
        );
    }

    public function getIterator()
    {
        return new ArrayObject($this->files);
    }

    public function map(Closure $function)
    {
        return array_map($function, $this->files);
    }

    public function getPath($name)
    {
        return $this->files[$name]["tmp_name"];
    }

    public function getType($name)
    {
        return $this->files[$name]["type"];
    }

    public function getSize($name)
    {
        return $this->files[$name]["size"];
    }

    public function getOriginalName($name)
    {
        return $this->files[$name]['name'];
    }
}
