<?php
namespace Simplicity\Library\AnnotationValidator\ConditionTraits;
trait Date
{
    /**
     * 日付フォーマットチェック
     * @param string $param
     * @param string $condition
     * @return bool
     */
    public static function date($param, $conditions)
    {
        $conditions = self::trimCondition($conditions);
        $conditions = ($conditions === "") ? "Y-m-d H:i:s" : $conditions;
        $timestamp_chars = [
            /**
             * Year
             */
            // 1970-2nnn
            "Y" => "(19[7-9][0-9]|2\d{3})",
            // 70-99
            "y" => "([0-9]{2})",
            // is leap year
            "L" => "[0-1]",
            // ISO8601 1970-2nnn
            "o" => "(19[7-9][0-9]|2\d{3})",
            /**
             * Month
             */
            // 01-12
            "m" => "(0[1-9]|1[0-2])",
            // 1-12
            "n" => "([1-9]|1[0-2])",
            // countable day of month
            "t" => "(2[8-9]|3[0-1])",
            // Month(3chars)
            "M" => "(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)",
            // Month(Full)
            "F" => "(January|Febrary|March|April|May|June|July|August|September|October|November|December)",
            /**
             * Day
             */
            // 01-31
            "d" => "(0[1-9]|1[0-9]|2[0-9]|3[0-1])",
            // 0-365 in year of day
            "z" => "([0-9]|[1-2][0-9][0-9]|3([0-5][0-9]|6[0-5]))",
            // 1-31
            "j" => "([1-9]|1[0-9]|2[0-9]|3[0-1])",
            // ordinal
            "S" => "(st|nd|rd|th)",
            /**
             * Hour
             */
            // 00-23
            "H" => "(0[0-9]|1[1-9])|2[0-3]",
            // 0-23
            "G" => "([0-9]|1[0-9]|2[0-3])",
            // 01-12
            "h" => "(0[1-9]|1[0-2])",
            // 1-12
            "g" => "([1-9]|1[0-2])",
            // am or pm
            "a" => "(am|pm)",
            // AM or PM
            "A" => "(AM|PM)",
            // Swatch 000-999
            "B" => "[0-9]{3}",

            /**
             * Minute
             */
            // 00-59
            "i" => "[0-5][0-9]",
            /**
             * Second
             */
            // 00-59
            "s" => "[0-5][0-9]",
            /**
             * MicroSecond
             */
            // 000000-999999
            "u" => "[0-9]{6}",
            /**
             * Week
             */
            // Week(3chars)
            "D" => "(Sun|Mon|Tue|Wed|Thu|Fri|Sat)",
            // Week(Full)
            "l" => "(Sunday|Monday|Tuesday|Wednesday|Thursday|Friday|Saturday)",
            // ISO-8601 1(Sun)-7(Sat)
            "N" => "[1-7]",
            // 0(Sun)-6(Sat)
            "w" => "[0-6]",
            // 0-54 week number of year
            "W" => "([1-9]|[1-4][0-9]|5[0-4])",
            /**
             * Timezone
             */
            // Timezone identifier
            "e" => "(".str_replace("/", "\/", implode("|", timezone_identifiers_list())).")",
            // Timezone identifier 3chars
            "T" => "(UTC|TAI|GMT|JST)",
            // is SummerTime
            "I" => "[0-1]",
            // sub GMT +2000
            "O" => "(\+|\-)([0-1][0-9]|2[0-3])[0-5][0-9]",
            // sub GMT +20
            "P" => "(\+|\-)([0-1][0-9]|2[0-3])\:[0-5][0-9]",
            // offset second from GMT
            "Z" => "(\-([0-3][0-9]{4}|4([0-2][0-9]{3}|3[0-2][0-9]{2}))|([0-4]([0-9]{4})|50[0-4][0-9]{2}))",
            /**
             * Other
             */
            // ISO 8601 Y-m-dTH:i:sP
            "c" => "(19[7-9][0-9]|2\d{3})-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3[0-1])T(0[0-9]|1[1-9])|2[0-3]\:[0-5][0-9]\:[0-5][0-9](\+|\-)([0-1][0-9]|2[0-3])\:[0-5][0-9]",
            // RFC 2822
            "r" => "",
            // Unix Epoch
            "U" => "(0{10}|0[1-9][0-9]{0,8}|1[0-9]{9}|20[0-9]{8}|21[0-3][0-9]{7}|214[0-6][0-9]{6}|2147[0-3][0-9]{5}|21474[0-7][0-9]{4}|214748[0-2][0-9]{3}|2147483[0-5][0-9]{2}|21474836[0-3][0-9]|214748364[0-7])",

        ];
        $conditions = join(array_map(function($char) use ($timestamp_chars) {
            return (array_key_exists($char, $timestamp_chars)) ? $timestamp_chars[$char] : $char;
        }, str_split($conditions)));
        return (bool)preg_match("/^{$conditions}$/", $param);
    }
}
