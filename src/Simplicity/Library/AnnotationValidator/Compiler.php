<?php
namespace Simplicity\Library\AnnotationValidator;
class Compiler
{
    /**
     * DocBlockから構造体を作る
     * @param String $key
     * @param String $comment
     * @return Array
     */
    public static function build($key, $comment)
    {
        return
            array_map(
                function($line) use ($key) {
                    return Compiler::toStruct($key, Compiler::trimLineToArray($line));
                }, self::convertToArray($comment)
            );
    }

    /**
     *	コメントを行ごとに配列化
     *	@param String $comment
     *	@return Array
     */
    public static function convertToArray($comment)
    {
        return array_values(array_filter(explode("\n", $comment), function($line) {
            return (str_replace(array("/**", "*/", "*"), "", trim(mb_convert_encoding($line, "utf-8", "auto"))) !== "");
        }));
    }

    /**
     *  行を空白除去し分解する
     *  @param String $line
     *  @return Array
     */
    public static function trimLineToArray($line)
    {
        return
            array_map(
                function($line) {
                    return trim($line);
                },
                array_values(
                    array_filter(
                        explode("@",
                            trim(preg_replace("/\s+/", " ",
                                preg_replace("/^\s{0,}\*\s{0,}/", "", trim($line))
                            ))
                        )
                    )
                )
            );
    }

    /**
     *  メソッド名・パラメータ・メッセージを格納した構造体を作成する
     *  @param String $key
     *  @param Array  $array
     *  @return Array[Struct]
     */
    public static function toStruct($key, Array $array)
    {
        // パラメータ数取得
        $count = count($array);
        if(0 === $count) { return; }

        $struct = new Struct;

        // 一つの時は型情報 or requiredのコメントなしのみ
        if(1 === $count) {
            $method = $array[0];
            $struct->method = $method;
            $struct->message = "{$key} is {$method}!";
        }
        // ２つの時は型情報 or require+コメント もしくは引数付きメソッドのコメント無し
        elseif(2 === $count) {
            $method = array_shift($array);
            /**
             * 引数は[]で囲うのでそれで判定
             */

            // メッセージの場合
            if(!preg_match("/^\[.*\]$/",$array[0])) {
                $struct->method  = $method;
                $struct->message = array_shift($array);
            }
            // 引数付きメソッドの場合
            else {
                $params = array_shift($array);
                $struct->method  = $method;
                $struct->params  = $params;
                $struct->message = "{$key} is {$method}: {$params}";
            }
        }
        // ３つの時は引数付きメソッドのコメントありのみ
        else {
            $method  = array_shift($array);
            $params  = array_shift($array);
            $message = array_shift($array);
            $struct->method  = $method;
            $struct->params  = $params;
            $struct->message = $message;
        }
        return $struct;
    }
}
