<?php
namespace Simplicity\Library\Http\Response\Output;

trait Contents
{
    /**
     * コンテンツの格納
     * @param String $content
     */
    public static function setContent($content)
    {
        self::setInstance();
        static::$response->setContent($content);
        return new self();
    }

    /**
     * コンテンツの送信
     * @param String $content
     */
    public static function sendContent($content, $mimetype = "text/html", $charset = "UTF-8") {
        self::setStatusCode(200);
        self::setHeader('Content-Length', strlen($content));
        self::setMimeType($mimetype);
        self::setContent($content);
        self::setCharset($charset);
        static::$response->prepare(\Simplicity\Library\Http\Request\Input::getInstance());
        return self::send();
    }
}
