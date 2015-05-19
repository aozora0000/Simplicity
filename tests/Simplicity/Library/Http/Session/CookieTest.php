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
        Cookie::start();
    }

}
