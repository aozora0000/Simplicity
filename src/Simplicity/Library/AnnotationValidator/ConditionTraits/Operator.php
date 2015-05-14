<?php
namespace Simplicity\Library\AnnotationValidator\ConditionTraits;
trait Operator
{
    /**
     * ENUMチェック
     * @param string $needle
     * @param string $conditions [x,y,z...]
     * @return bool
     */
    public static function enum($needle, $conditions)
    {
        $haystack = self::trimStackCondition($conditions);
        return (bool)in_array($needle, $haystack);
    }

    /**
     * 文字列長チェック
     * @param integer $params
     * @param string $conditions [min,max]
     * @return bool
     */
    public static function length($params, $conditions)
    {
        list($min,$max) = self::intStackCondition($conditions);
        $length = strlen($params);

        if($min === 0 && $max === 0) {
            return true;
        } elseif($min === 0) {
            return ($length <= $max);
        } elseif ($max === 0) {
            return ($length > $min);
        } else {
            return (
                ($length > $min) &&
                ($length <= $max)
            );
        }
    }

    /**
     * 範囲チェック
     * @param integer $param
     * @param string $condition [min,max]
     * @return bool
     */
    public static function range($params, $conditions)
    {
        list($min, $max) = self::intStackCondition($conditions);
        $params = (int)$params;
        if($min === 0 && $max === 0) {
            return true;
        } elseif($min === 0) {
            return ($params <= $max);
        } elseif ($max === 0) {
            return ($params >= $min);
        } else {
            return (
                ($params >= $min) &&
                ($params <= $max)
            );
        }
    }

    /**
     * 最小値チェック
     * @param integer|float $param
     * @param string $condition [min]
     * @return bool
     */
    public static function min($param, $conditions)
    {
        $min = (int)self::trimCondition($conditions);
        return ($min <= $param);
    }

    /**
     * 最大値チェック
     * @param integer|float $param
     * @param string $condition [min]
     * @return bool
     */
    public static function max($param, $conditions)
    {
        $max = (int)self::trimCondition($conditions);
        return ($param <= $max);
    }
}
