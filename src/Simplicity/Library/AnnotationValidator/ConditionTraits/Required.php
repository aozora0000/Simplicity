<?php
namespace Simplicity\Library\AnnotationValidator\ConditionTraits;
trait Required
{
    /**
     * 必須項目のチェック
     * @param Array  $params
     * @param String $name
     * @return bool
     */
    public static function required(Array $params, $name)
    {
        return (isset($params[$name]) && $params[$name] !== "");
    }
}
