<?php
namespace Simplicity\Library\Http\Request;

/**
 * @see https://github.com/symfony/HttpFoundation/blob/master/Request.php
 */
class Input
{
    /**
     * @var Illuminate\Http\Request
     */
    static $request = false;

    /**
     * リクエストインスタンスの取得・
     */
    private static function setInstance()
    {
        static::$request = static::$request?: \Illuminate\Http\Request::createFromGlobals();
    }

    /**
     * リクエストインスタンスを返す
     * @return Illuminate\Http\Request
     */
    public static function getInstance()
    {
        self::setInstance();
        return static::$request;
    }

    /**
     * Symfony\Component\HttpFoundation\File\UploadedFileインスタンスの取得
     * @param  String $name
     * @return Array | Symfony\Component\HttpFoundation\File\UploadedFile
     */
    public static function file($name = null)
    {
        self::setInstance();
        return static::$request->file($name);
    }

    /**
     * GET,POST,COOKIEの取得
     * @param  String $name
     * @param  mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        self::setInstance();
        return static::$request->get($key, $default);
    }

    /**
     * HTTPメソッドの取得
     * @return String
     */
    public static function method()
    {
        self::setInstance();
        return static::$request->getMethod();
    }
    /**
     * XMLHttpRequestの判定
     * @return bool
     */
    public static function isAjax()
    {
        self::setInstance();
        return static::$request->isXmlHttpRequest();
    }

    /**
     *
     */
    public static function requestUri()
    {
        self::setInstance();
        return static::$request->getRequestUri();
    }
}
