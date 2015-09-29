<?php
namespace SimplicityTest\Library\Http\Session;
use \Simplicity\Library\Http\Session\Cookie;

/**
 * Class CookieTest
 * @package SimplicityTest\Library\Http\Session
 * @group Session
 */
class CookieTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @runInSeparateProcess
     */
    public function get()
    {
        $params = new \stdClass;
        $params->test = 1;
        $_COOKIE[__COOKIE__] = json_encode($params);
        Cookie::start();
        $test = Cookie::get("test");
        $this->assertEquals(1, $test);
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function set()
    {
        Cookie::start();
        Cookie::expire(strtotime("1970-01-01 10:00:00") + 3600)->path("/")->domain("localhost:8080")->secure(true)->httpOnly(false);
        $test = Cookie::set("test", 1)->commit();
        $output_header = xdebug_get_headers();
        $this->assertEquals(12, strpos($output_header[0], "SIMPLICITY_COOKIE=%7B%22test%22%3A1%7D;"), "クッキーが格納されていない？");
        $this->assertEquals(52, strpos($output_header[0], "expires=Thu, 01-Jan-1970 02:00:00 GMT;"), "expireが格納されていない？");
        $this->assertEquals(112, strpos($output_header[0], "path=/;"), "pathが格納されていない？");
        $this->assertEquals(120, strpos($output_header[0], "domain=localhost:8080;"), "ドメインが格納されていない？");
        $this->assertEquals(143, strpos($output_header[0], "secure"), "secure属性が設定されていない？");
        $this->assertFalse(strpos($output_header[0], "httpOnly"), "httpOnly属性が設定されている？");
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function remove()
    {
        Cookie::start();
        Cookie::set("test", 1)->commit();
        Cookie::remove("test");
        $this->assertEmpty(Cookie::get("test", null));
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function clear()
    {
        $params = new \stdClass;
        $params->test = 1;
        $_COOKIE[__COOKIE__] = json_encode($params);
        Cookie::start();
        Cookie::clear();
        $output_header = xdebug_get_headers();
        $this->assertEquals(12, strpos($output_header[0], "SIMPLICITY_COOKIE=%7B%7D;"), "COOKIEがクリアされていない？");
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function map()
    {
        $params = new \stdClass;
        $params->name = "KoheiKinoshita";
        $params->age  = 30;
        $_COOKIE[__COOKIE__] = json_encode($params);
        Cookie::start();
        $map = Cookie::map(function($v, $k) {
            switch($k) {
                case "name":
                    return strtolower($v); break;
                case "age":
                    return $v + 1; break;
                default:
                    return $v;
            }
        });
        $this->assertEquals(31, $map['age']);
        $this->assertEquals("koheikinoshita", $map['name']);
    }

}
