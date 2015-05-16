<?php
namespace Simplicity\Library\Http\Response\Output;
use Datetime;
trait Cache
{

    /**
     * キャッシュコントロールをpublicに設定する
     */
    public static function setPublic()
    {
        self::setInstance();
        static::$response->setPublic();
        return new self();
    }
    /**
     * キャッシュコントロールをpublicに設定する
     */
    public static function setPrivate()
    {
        self::setInstance();
        static::$response->setPrivate();
        return new self();
    }

    /**
     * 生存期限の格納
     * @param \DateTime $date
     */
    public static function setExpire(DateTime $date)
    {
        self::setInstance();
        static::$response->setExpires($date);
        return new self();
    }
}
