<?php
namespace Simplicity\Library\AnnotationValidator\ConditionTraits;
trait String
{
    /**
     * 文字列が含まれるかチェック (or)
     * @param String $string
     * @param String $conditions
     * @return bool
     */
    public static function orContain($string, $conditions)
    {
        $bool = 0;
        $haystacks = self::trimStackCondition($conditions);
        foreach($haystacks as $stack) {
            if(strpos($stack, $string) !== false) {
                $bool = 1;
            }
        }
        return (bool)$bool;
    }

    /**
     * 文字列が含まれるかチェック (and)
     * @param String $string
     * @param String $conditions
     * @return bool
     */
    public static function andContain($string, $conditions)
    {
        $bool = 1;
        $haystacks = self::trimStackCondition($conditions);
        foreach($haystacks as $stack) {
            if(strpos($stack, $string) === false) {
                $bool = 0;
            }
        }
        return !(bool)$bool;
    }

    /**
     * 半角英字チェック
     * @param  String $string
     * @return bool
     */
    public static function alphabet($string)
    {
        return (bool)preg_match("/^[a-zA-Z]+$/", $string);
    }

    /**
     * 半角数字チェック
     * @param String $string
     * @return bool
     */
    public static function numeric($string)
    {
        return (bool)preg_match("/^[0-9]+$/",$string);
    }

    /**
     * 半角英数字チェック
     * @param String $string
     * @return bool
     */
    public static function alphanumric($string)
    {
        return (bool)preg_match("/^[a-zA-Z0-9]+$/",$string);
    }

    /**
     * 全角チェック
     * @param String $string
     * @return bool
     */
    public static function zenkaku($string)
    {
        return (bool)preg_match("/^[^\x00-\x7F]+$/", $string);
    }

    /**
     * 半角チェック
     * @param String $string
     * @return bool
     */
    public static function hankaku($string)
    {
        return (bool)preg-match("/^[ -~｡-ﾟ]$/",$string);
    }
}
