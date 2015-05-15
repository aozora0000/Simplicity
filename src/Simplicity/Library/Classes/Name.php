<?php
namespace Simplicity\Library\Classes;
class Name
{
    /**
     * クラスとメソッドを分けて出力
     * @param  String $class
     * @return Struct\Name
     */
    public static function splitClassMethod($class)
    {
        list($class, $method) = explode("::", $class);
        $name = new Struct\Name;
        $name->setClass(new Struct\Classes(self::getSeparateName($class)));
        $name->setMethod(new Struct\Methods(array($method)));
        return $name;
    }

    /**
     * クラス・メソッド名をトリムして取得
     * @param  String $class
     * @return String
     */
    public static function getFullName($class)
    {
        return str_replace("\\", '\\', $class);
    }

    /**
     * セパレーター区切りで配列を作り取得
     * @param  String $class
     * @return Array
     */
    public static function getSeparateName($class)
    {
        return array_values(array_filter(explode("\\", self::getFullName($class))));
    }

    /**
     * 名前空間を除外したクラス::メソッド名を返す
     * @param  String $class
     * @return String
     */
    public static function getTrimNameSpace($class)
    {
        $classArray = self::getSeparateName($class);
        return end($classArray);
    }
}
