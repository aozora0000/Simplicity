<?php
namespace SimplicityTest\Library\Http\Request;
use \Simplicity\Library\Http\Request\Method;
class MethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function get()
    {
        $_SERVER['REQUEST_METHOD'] = "GET";
        $this->assertEquals("GET", Method::get());
    }

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function post()
    {
        $_SERVER['REQUEST_METHOD'] = "POST";
        $this->assertEquals("POST", Method::get());
    }
    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function head()
    {
        $_SERVER['REQUEST_METHOD'] = "HEAD";
        $this->assertEquals("HEAD", Method::get());
    }
    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function delete()
    {
        $_SERVER['REQUEST_METHOD'] = "DELETE";
        $this->assertEquals("DELETE", Method::get());
    }

    /**
     * @test
     */
    public function isAjax()
    {
        $this->assertNotTrue(Method::isAjax());
    }
}
