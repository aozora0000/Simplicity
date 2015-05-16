<?php
namespace SimplicityTest\Library\Http\Request;
use \Simplicity\Library\Http\Request\Request;
class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $_GET['a'] = "1";
        $_POST['b'] = "2";
    }
    /**
     * @test
     * @runInSeparateProcess
     */
    public function get()
    {
        $this->assertEquals("1", Request::get("a"));
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function getAll()
    {
        $this->assertEquals(array('a'=>"1",'b'=>"2"), Request::getAll());
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function map()
    {
        $map = Request::map(function($value) { return (int)$value; });
        $this->assertEquals(array('a'=>1, 'b'=>2), $map);
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function filter()
    {
        $filter = Request::filter(function($value) { return ($value % 2); });
        $this->assertEquals(array('a'=>'1'), $filter);
    }
}
