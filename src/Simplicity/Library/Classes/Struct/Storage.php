<?php
namespace Simplicity\Library\Classes\Struct;
class Storage {
    public function __get($name) {
        return $this->$name->getIterator();
    }
}
