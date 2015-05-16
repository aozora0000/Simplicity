<?php
namespace Simplicity\Library\Http\Request;
class Method
{
    public static function get()
    {
        return Input::method();
    }

    public static function isAjax()
    {
        return Input::isAjax();
    }
}
