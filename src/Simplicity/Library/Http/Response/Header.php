<?php
namespace Simplicity\Library\Http\Response;
class Header
{
    /**
     *  ブラウザキャッシュ無効ヘッダーの出力
     *  Cache-Control: no-cache, private
     *  PRAGMA:        no-cache
     *  Date:          Sat, 16 May 2015 05:10:35 GMT
     *  Expires:       Sat, 16 May 2015 05:10:35 GMT
     *  @return \Illuminate\Http\Response
     */
    public static function noCache()
    {
        Output::setHeader('Cache-Control', 'no-cache');
        Output::setHeader('PRAGMA', 'no-cache');
        Output::setPrivate();
        Output::setDate(new \Datetime("now"));
        Output::setExpire(new \Datetime("now"));
        return Output::getInstance();
    }
}
