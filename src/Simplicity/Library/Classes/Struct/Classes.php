<?php
namespace Simplicity\Library\Classes\Struct;
use \ArrayObject;

class Classes extends ArrayObject
{
    public function __construct($array){
        parent::__construct($array, ArrayObject::ARRAY_AS_PROPS);
    }
}
