<?php
namespace Simplicity\Library\AnnotationValidator\Dummy;

class Behavior extends \Simplicity\Library\AnnotationValidator\Behavior
{
    public static function true($param)
    {
        return true;
    }

    public static function false($params, $condition) {
        return false;
    }

    public static function hasTrue($params)
    {
        return false;
    }
}
