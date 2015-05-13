<?php
namespace Simplicity\View;
abstract class Base
{
    protected $container;
    protected $obj;
    protected $engine;

    public function __construct($container)
    {
        $this->container = $container;
        $this->obj = array();
    }

    public function setEngine($engine) {
        $this->engine = $this->container[$engine];
    }

    public function __set($name, $value)
    {
        $this->obj[$name] = $value;
    }

    abstract public function render($filename);
}
