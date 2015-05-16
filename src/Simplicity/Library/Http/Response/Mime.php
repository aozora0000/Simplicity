<?php
namespace Simplicity\Library\Http\Response;
use \Exception;

class Mime extends MimeTypeList
{
    /**
     * ファイル拡張子からMimeTypeを取得する
     * @param  String $extension
     * @return String
     * @throws \Exception
     */
    public static function getFromExtension($extension = ".txt")
    {
        $extensionUpper = strtoupper(str_replace(".", "", $extension));
        if(defined("self::{$extensionUpper}")) {
            return constant("self::{$extensionUpper}");
        } else {
            throw new Exception("'{$extension}' MimeType Not Found!");
        }
    }

    /**
     * ファイルパス・URLからMimeTypeを取得する
     * @param  String $path
     * @return String
     * @throws \Exception
     */
    public static function getFromPath($path)
    {
        $fileInfo = pathinfo(basename($path));
        return self::getFromExtension($fileInfo['extension']);
    }
}
