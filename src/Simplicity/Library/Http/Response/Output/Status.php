<?php
namespace Simplicity\Library\Http\Response\Output;

trait Status
{
    public static function setStatusCode($code = 200)
    {
        self::setInstance();
        static::$response->setStatusCode($code);
        return new self();
    }
}
