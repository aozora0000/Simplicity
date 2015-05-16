<?php
namespace Simplicity\Library\Http\Response\Output;

trait MimeType
{
    public static function setMimeType($mimetype)
    {
        self::setInstance();
        self::setHeader('Content-type', $mimetype);
        return new self();
    }
}
