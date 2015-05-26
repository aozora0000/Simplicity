<?php
namespace SimplicityTest\Library\Http\Session;
use \Simplicity\Library\Http\Session\Cookie;
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
        $test = Cookie::set("test", 1)->expire(strtotime("1970-01-01 10:00:00") + 3600)->commit();
        $output_header = xdebug_get_headers();
        $this->assertEquals(12, strpos($output_header[0], "SIMPLICITY_COOKIE=%7B%22test%22%3A1%7D;"));
    }
}
