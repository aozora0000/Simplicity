<?php
namespace Simplicity\Library\Http\Request;

class Uri
{
    public static function get()
    {
        return Input::requestUri();
    }
}
