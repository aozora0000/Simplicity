<?php
namespace Simplicity\Library\AnnotationValidator\ConditionTraits;
trait Access
{
    /**
     * 電話番号のチェック
     * @param String $string
     * @return bool
     */
    public static function phone($string)
    {
        $string = str_replace("-", "", $string);
        return (bool)preg_match("/^[0-9]{10,11}$/", $string);
    }

    /**
     * 郵便番号のチェック
     * @param String $string
     * @return bool
     */
    public static function zipcode($string)
    {
        $string = str_replace("-", "", $string);
        return (bool)preg_match("/^\d{7}$/", $string);
    }
}
