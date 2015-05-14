<?php
namespace Simplicity\Library\AnnotationValidator\ConditionTraits;

trait Web
{
    /**
     * メールアドレスチェック
     * @param String $string
     * @return bool
     */
    public static function mail($string)
    {
        return (bool)preg_match("/^[-+.\\w]+@[-a-z0-9]+(\\.[-a-z0-9]+)*\\.[a-z]{2,6}$/i", $string);
    }

    /**
     * URLチェック
     * @param String $string
     * @return bool
     */
    public static function url($string)
    {
        return (bool)preg_match("/^(https?|ftp|file)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/", $string);
    }

    /**
     * ドメインチェック
     * @param String $string
     * @return bool
     */
    public static function domain($string)
    {
        return (bool)preg_match("/^([A-Za-z0-9][A-Za-z0-9\-]{1,61}[A-Za-z0-9]\.)+[A-Za-z]+$/", $string);
    }

    /**
     * IP version4チェック
     * @param String $string
     * @return bool
     */
    public static function ipv4($string)
    {
        return (bool)preg_match("/^(([1-9]|[1-9][0-9]|1[0-9][0-9]|2([0-4][0-9]|5[0-5]))\.)(([0-9]|[1-9][0-9]|1[0-9][0-9]|2([0-4][0-9]|5[0-5]))\.){2}([1-9]|[1-9][0-9]|1[0-9][0-9]|2([0-4][0-9]|5[0-5]))(\:([1-9][0-9]{1,4}))?$/", $string);
    }

    public static function ipv6($string)
    {
        return (bool)preg_match("/^::|(?:[0-9a-fA-F]{1,4}:){1,7}:|:(?::[0-9a-fA-F]{1,4}){1,7}|(?:[0-9a-fA-F]{1,4}:){7}[0-9a-fA-F]{1,4}|(?:[0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}$/", $string);
    }
}
