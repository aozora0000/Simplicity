<?php
namespace Simplicity\Library\Http\Request;
use \Closure;

class Request
{
    /**
     * $_POST,$_GETから名前の値を取得する
     * @param  String $key
     * @param  mixed  $default
     * @return Array
     */
    public static function get($key, $default = null)
    {
        return Input::get($key, $default);
    }

    /**
     * $_POST,$_GETから値を全て取得する
     * @param  Array  $default
     * @return Array
     */
    public static function getAll(array $defaults = array())
    {
        $input_keys = array_keys(array_merge($_GET,$_POST));
        $returnArray = array();

        foreach($input_keys as $key) {
            $default = (isset($defaults[$key])) ? $defaults[$key] : null;
            $returnArray[$key] = Input::get($key, $default);
        }
        return $returnArray;
    }

    /**
     * $_POST,$_GETを再帰的に操作・取得する
     * @param  Closure | callable $closure
     * @return Array
     */
    public static function map($closure)
    {
        return array_map($closure, self::getAll());
    }

    /**
     * $_POST,$_GETを再帰的にフィルタリングする
     * @param  Closure | callable $closure
     * @return Array
     */
    public static function filter($closure)
    {
        return array_filter(self::getAll(), $closure);
    }
}
