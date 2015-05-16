<?php
namespace SimplicityTest\Model;
use \Simplicity\Model\Base;

class BaseTest extends \PHPUnit_Framework_TestCase
{
    protected $model;

    public function setUp()
    {
        $this->model = new Base(\TestContainer::getInstance());
    }

    /**
     * @test
     */
    public function SetterAndBinder()
    {
        $this->model->test = 1;
        $this->assertEquals(array(":test"=>1), $this->model->getbind());
    }

    /**
     * @test
     */
    public function GetNextID()
    {
        $this->assertEquals(2, $this->model->getNextID());
    }

    /**
     * @test
     */
    public function GetNextIDFailedCase()
    {
        $model = new \ReflectionClass(new Base(\TestContainer::getInstance()));
        $property = $model->getProperty("driver");
        $property->setAccessible(true);
        $property->setValue($this->model, "MySQL");
        $this->assertNotTrue($this->model->getNextID());
    }

    public function tearDown()
    {
        $this->model = null;
    }
}
