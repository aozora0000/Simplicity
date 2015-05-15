<?php
namespace Simplicity\Library\Classes\Struct;
use \ArrayObject;

class Methods extends ArrayObject
{
    public function __construct($array){
        parent::__construct($array, ArrayObject::ARRAY_AS_PROPS);
    }
}
