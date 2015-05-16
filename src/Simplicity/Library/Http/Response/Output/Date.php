<?php
namespace Simplicity\Library\Http\Response\Output;
use \DateTime;

trait Date
{
    /**
     * 作成日時の格納
     * @param \DateTime $date
     */
    public static function setDate(\DateTime $date)
    {
        self::setInstance();
        static::$response->setDate($date);
        return new self();
    }
}
