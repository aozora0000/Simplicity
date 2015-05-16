<?php
namespace Simplicity\Library\Http\Request;
use \Closure;

class File
{
    /**
     * $_FILEの取得
     * @param String | Null $name
     * @return Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public static function get($name = null)
    {
        return Input::file($name);
    }

    /**
     * $_FILEを再帰的に処理
     * @param  Closure $closure
     * @return Array
     */
    public static function map(Closure $closure)
    {
        return array_map($closure, Input::file());
    }
}
