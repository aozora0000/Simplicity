<?php
namespace SimplicityTest\Library\Http\Request;
use \Simplicity\Library\Http\Request\Input;
class InputTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function getInstance()
    {
        $this->assertEquals("Illuminate\Http\Request", get_class(Input::getInstance()));
    }
}
