<?php
namespace Simplicity\Library\Http\Response\Output;

trait Common
{
    /**
     * レスポンスインスタンスの作成
     */
    private static function setInstance()
    {
        static::$response = static::$response?: new \Illuminate\Http\Response;
    }

    /**
     * レスポンスインスタンスの返却
     * @return \Illuminate\Http\Response
     */
    public static function getInstance()
    {
        self::setInstance();
        return static::$response;
    }

    /**
     * ヘッダー情報の格納
     */
    public static function setHeader($key, $value)
    {
        self::setInstance();
        static::$response->headers->set($key, $value);
        return new self();
    }

    /**
     * クライアントへ送信
     */
    public static function send()
    {
        self::setInstance();
        return static::$response->send();
    }
}
