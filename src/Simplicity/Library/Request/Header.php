<?php
namespace Simplicity\Library\Request;
class Header
{
    public static function redirect($url)
    {
        header("Location: {$url}");exit;
    }

    public static function notFound($redirect = null)
    {
        header("HTTP/1.0 404 Not Found");
        if($redirect) {
            header("Location: {$redirect}");
        }
        exit;
    }
}
