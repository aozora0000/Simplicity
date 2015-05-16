<?php
namespace Simplicity\Library\Http\Response;
class Json
{
    protected $object;
    
    public function __construct($object = array())
    {
        $this->object = $object;
    }

    public function setObject($object)
    {
        $this->object = $object;
    }

    public function __set($name, $value)
    {
        $this->object[$name] = $value;
    }

    public function __get($name)
    {
        return isset($this->object[$name]) ? $this->object[$name] : null;
    }

    public function __toString()
    {
        return json_encode($this->object, JSON_UNESCAPED_UNICODE);
    }

    public function send()
    {
        Output::sendContent($this, "application/json", "UTF-8");
        return Output::send();
    }

    public function __destruct()
    {
        $this->object = null;
    }
}
