<?php
namespace Simplicity\Library\AnnotationValidator\ConditionTraits;
trait Common
{
    /**
     * 引数パラメータのトリム
     * @param String $condition
     * @return String
     */
    private static function trimCondition($conditions)
    {
        return str_replace(array("[","]"), "", $conditions);
    }

    /**
     * 引数パラメータのトリムとパース
     * @param String $condition
     * @return Array
     */
    private static function trimStackCondition($conditions)
    {
        return
            array_map(
                function($param) {
                    return trim($param);
                },
                explode(",", self::trimCondition($conditions))
            );
    }

    /**
     * 引数パラメータのトリム・整数化とパース
     * @param String $condition
     * @return Array[int]
     */
    private static function intStackCondition($conditions)
    {
        return
            array_map(
                function($param) {
                    return (int)trim($param);
                },
                explode(",", self::trimCondition($conditions))
            );
    }
}
