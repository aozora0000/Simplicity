<?php
namespace Simplicity\Library\Http\Session;
use \Closure;
use \Ginq;
class Cookie
{
    /**
     * @var Integer
     */
    static $expire   = 0;

    /**
     * @var String
     */
    static $path     = '/';

    /**
     * @var String
     */
    static $domain   = __HOST__;

    /**
     * @var String
     */
    static $secure   = __SECURE__;

    /**
     * @var boolean
     */
    static $httpOnly = true;

    /**
     * @var stdClass
     */
    static $cookie   = false;

    /**
     * $_COOKIEの格納
     */
    public static function start()
    {
        if(!static::$cookie) {
            $cookie = (isset($_COOKIE[__COOKIE__])) ? json_decode($_COOKIE[__COOKIE__]) : json_decode("{}");
            static::$cookie = $cookie;
        }
    }

    /**
     * cookieから値を取得する
     * @param   String $name
     * @param   mixed  $default
     * @return  mixed
     */
    public static function get($name, $default = null)
    {
        self::start();
        return isset(static::$cookie->$name) ? static::$cookie->$name : $default;
    }

    /**
     * cookieに値をセットする
     * @param   String $name
     * @param   mixed  $value
     * @return  self
     */
    public static function set($name, $value)
    {
        self::start();
        static::$cookie->$name = $value;
        return new self();
    }

    /**
     * cookieに期限をセットする
     * @param  Integer $integer
     * @return self
     */
    public static function expire($expire)
    {
        static::$expire = (int)$expire;
        return new self();
    }

    /**
     * cookieにパスをセットする
     * @param  String $path
     * @return self
     */
    public static function path($path)
    {
        static::$path = $path;
        return new self();
    }

    /**
     * cookieにドメインをセットする
     * @param  String $domain
     * @return self
     */
    public static function domain($domain)
    {
        static::$domain = $domain;
        return new self();
    }

    /**
     * cookieにsecure属性をセットする
     * @param  boolean $secure
     * @return self
     */
    public static function secure($secure)
    {
        static::$secure = (bool)$secure;
        return new self();
    }

    /**
     * cookieにhttpOnly属性をセットする
     * @param  boolean $httpOnly
     * @return self
     */
    public static function httpOnly($httpOnly)
    {
        static::$httpOnly = (bool)$httpOnly;
        return new self();
    }

    /**
     * セットされているクッキー情報を消去する
     * @param  String $name
     * @return self
     */
    public static function remove($name)
    {
        self::start();
        unset(static::$cookie->$name);
        return new self();
    }

    /**
     * クッキー情報を消去する
     * @return self
     */
    public static function clear()
    {
        self::start();
        static::$cookie = new \stdClass;
        self::commit();
        return new self();
    }

    /**
     * クッキー配列の全ての値に対して関数を実行する
     * @param $closure
     * @return \stdClass
     */
    public static function map(Closure $closure)
    {
        self::start();
        return Ginq::from((array)static::$cookie)->map($closure)->toArray();
        //array_map($closure, array_keys((array)static::$cookie), (array)static::$cookie);
    }

    /**
     * クッキー情報をJsonエンコードしてコミットする
     * @return self
     * @throws \Exception
     */
    public static function commit()
    {
        self::start();
        if(setcookie(__COOKIE__, json_encode(static::$cookie), static::$expire, static::$path, static::$domain, static::$secure, static::$httpOnly)) {
            return new self();
        } else {
            throw new \Exception("Cookie Set Failed!");
        }
    }
}
