<?php
namespace Simplicity\Library\AnnotationValidator\ConditionTraits;
trait Geometory
{
    /**
     * 位置情報(GEO)コード 経度のチェック (-+)180.00.....
     * @param String $string
     * @return bool
     */
    public static function longitude($string)
    {
        return (bool)preg_match("/^([-+]?([0-9]{1,2}|1[0-7][0-9]|180)([.]\d+)?)$/", $string);
    }

    /**
     * 位置情報(GEO)コード 緯度のチェック (-+)90.00.....
     */
    public static function latitude($string)
    {
        return (bool)preg_match("/^([-+]?([0-9]|[1-8][0-9]|90)([.]\d+)?)$/", $string);
    }

    /**
     * 位置情報(GEO)コード 緯度経度のチェック(カンマ区切り)
     * @param String $string
     * @return bool
     */
    public static function latlng($string) {
        return (bool)preg_match("/^[-+]?([0-9]|[1-8][0-9]|90)([.]\d+),(\s+)[-+]?([0-9]{1,2}|1[0-7][0-9]|180)([.]\d+)$/", $string);
    }
}
