<?php
namespace Simplicity;
class Loader
{
    static $container;

    public static function registContainer($container) {
        static::$container = $container;
    }

    public static function getInstance($className)
    {
        if(empty(static::$container)) {
            return new $className;
        } else {
            return new $className(static::$container);
        }
    }
}
