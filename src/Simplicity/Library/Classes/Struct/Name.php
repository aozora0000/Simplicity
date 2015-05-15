<?php
namespace Simplicity\Library\Classes\Struct;
class Name
{
    protected $storage;

    public function __construct()
    {
        $this->storage = new Storage;
    }

    public function setClass(Classes $classes)
    {
        $this->storage->classes = $classes;
    }

    public function getClass()
    {
        return $this->storage->classes;
    }

    public function setMethod(Methods $methods)
    {
        $this->storage->methods = $methods;
    }

    public function getMethod()
    {
        return $this->storage->methods;
    }

    public function getIterator()
    {
        return $this->storage;
    }
}
