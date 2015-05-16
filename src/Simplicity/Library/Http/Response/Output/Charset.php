<?php
namespace Simplicity\Library\Http\Response\Output;

trait Charset
{
    /**
     * レスポンスの文字コード設定
     * @param  String $charset
     * @return Output
     */
    public static function setCharset($charset = "UTF-8")
    {
        self::setInstance();
        static::$response->setCharset($charset);
        return new self();
    }
}
