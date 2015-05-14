<?php
namespace Simplicity\Library\AnnotationValidator;
class Struct
{
    protected $method;
    protected $params;
    protected $message;

    public function __get($name)
    {
        return (empty($this->$name)) ? false : $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function isRequired()
    {
        return (isset($this->method) && $this->method === "required");
    }
}
