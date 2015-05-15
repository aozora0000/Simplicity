<?php
namespace SimplicityTest\Library\Classes\Struct;
use \Simplicity\Library\Classes\Struct;

class NameTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->name = new Struct\Name;
    }

    /**
     * @test
     */
    public function testClass()
    {
        $this->name->setClass(new Struct\Classes(array()));
        $this->assertEmpty($this->name->getClass());
    }

    /**
     * @test
     */
    public function testMethods()
    {
        $this->name->setMethod(new Struct\Methods(array()));
        $this->assertEmpty($this->name->getMethod());
    }
}
