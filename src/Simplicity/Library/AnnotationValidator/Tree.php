<?php
namespace Simplicity\Library\AnnotationValidator;
class Tree
{
    public static function get($key, $comment)
    {
        return
            array_map(
                function($line) use ($key) {
                    return Tree::parse($key, Tree::params($line));
                }, self::trim($comment)
            );
    }

    private static function trim()
    {
        return array_filter(explode("\n", $comment), function($line) {
            return (str_replace(array("/**", "*/", "*"), "", trim($line)) !== "");
        });
    }

    public static function params($string)
    {
        return explode(" ", preg_replace("/\s+/", " ", preg_replace("/^\s{0,}\*\s{0,}/", "", str_replace("@", "", $line))));
    }

    public static function parse($key, Array $array)
    {
        // パラメータ数取得
        $count = count($array);
        if(0 === $count) { return; }
        // 一つの時は型情報 or requiredのコメントなしのみ
        if(1 === $count) {
            $method = $array[0];
            return array(
                "method"  => $method,
                "message" => "{$key} is {$method}!"
            );
        }
        // ２つの時は型情報 or require+コメント もしくは引数付きメソッドのコメント無し
        elseif(2 === $count) {
            $method = array_shift($array);
            /**
             * 引数は[]で囲うのでそれで判定
             */

            // メッセージの場合
            if(!preg_match("/^\[.*\]$/",$array[0])) {
                $message = array_shift($array);
                return array(
                    "method"  => $method,
                    "message" => $message
                );
            }
            // 引数付きメソッドの場合
            else {
                $params = array_shift($array);
                return array(
                    "method"  => $method,
                    "params"  => $params,
                    "message" => "{$key} is {$method}: {$params}"
                );
            }
        }
        // ３つの時は引数付きメソッドのコメントありのみ
        else {
            $method  = array_shift($array);
            $params  = array_shift($array);
            $message = array_shift($array);
            return array(
                "method"  => $method,
                "params"  => $params,
                "message" => $message
            );
        }
    }
}
