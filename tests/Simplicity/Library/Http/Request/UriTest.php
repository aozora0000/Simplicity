<?php
namespace SimplicityTest\Library\Http\Request;
use Simplicity\Library\Http\Request\Uri;

class UriTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function get()
    {
        $_SERVER['REQUEST_URI'] = "/index.php";
        $this->assertEquals("/index.php", Uri::get());
    }
}
