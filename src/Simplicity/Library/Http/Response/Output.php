<?php
namespace Simplicity\Library\Http\Response;
use \DateTime;
/**
 * @see https://github.com/symfony/HttpFoundation/blob/master/Request.php
 */
class Output
{
    /**
     * @var \Illuminate\Http\Request
     */
    static $response = false;

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
    }

    /**
     * 作成日時の格納
     * @param \DateTime $date
     */
    public static function setDate(DateTime $date)
    {
        self::setInstance();
        static::$response->setDate($date);
    }

    /**
     * 生存期限の格納
     * @param \DateTime $date
     */
    public static function setExpire(DateTime $date)
    {
        self::setInstance();
        static::$response->setExpires($date);
    }

    /**
     * コンテンツの格納
     * @param String $content
     */
    public static function setContent($content)
    {
        self::setInstance();
        static::$response->setContent($content);
    }

    /**
     * キャッシュコントロールをpublicに設定する
     */
    public static function setPublic()
    {
        self::setInstance();
        static::$response->setPublic();
    }
    /**
     * キャッシュコントロールをpublicに設定する
     */
    public static function setPrivate()
    {
        self::setInstance();
        static::$response->setPrivate();
    }

    /**
     * クライアントへ送信
     */
    public static function send()
    {
        self::setInstance();
        static::$response->send();
    }


    /**
     * コンテンツの送信
     * @param String $content
     */
    public static function sendContent($content) {
        self::setHeader('Content-Length', strlen($content));
        self::setContent($content);
        static::$response->prepare(\Simplicity\Library\Http\Request\Input::getInstance());
        self::send();
    }
}
