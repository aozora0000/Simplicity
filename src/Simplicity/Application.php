<?php
namespace Simplicity;

class Application
{
    /**
     * PimpleDIContainer
     * @var Pimple/Container
     */
    private static $container;

    /**
     * registerContainer
     * @var Pimple/Container $container
     * @return void
     */
    public static function registContainer($container) {
        static::$container = $container;
        return new self();
    }

    /**
     * resister function in Container static binding
     * @param callable|\Closure $closure
     * @internal param callable $closure
     */
    public static function register($key, \Closure $closure)
    {
        static::$container[$key] = $closure;
    }

    /**
     * register ClassAlias From Array
     * @var array $aliases
     */
    public static function registerAlias(array $aliases)
    {
        foreach($aliases as $shortName=>$className) {
            class_alias($className, $shortName, false);
        }
    }

    /**
     * create new Instance
     * @var String $classname
     * @return Instance
     */
    public static function getInstance($className)
    {
        if(empty(static::$container)) {
            return new $className;
        } else {
            return new $className(static::$container);
        }
    }

    /**
     * get From PimpleContainer
     * @var string $key
     * @return mixed[null, Instance]
     */
    public static function get($key)
    {
        if(empty(static::$container)) {
            return null;
        }
        if(empty(static::$container[$key])){
            return null;
        }
        $closure = static::$container[$key];
        return $closure();
    }
}
