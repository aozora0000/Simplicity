<?php
namespace SimplicityTest\Model;
use \Simplicity\Model\Example;

/**
 * Class ExampleTest
 * @package SimplicityTest\Model
 * @group MODEL
 * @group UNIT
 */
class ExampleTest extends \PHPUnit_Framework_TestCase
{
    protected $model;

    public function setUp()
    {
        $this->model = new Example(\TestContainer::getInstance());
    }

    /**
     * @test
     */
    public function get()
    {
        $this->model->id = 1;
        $result = $this->model->get();
        $this->assertObjectHasAttribute("id", $result);
        $this->assertEquals(1, $result->id);
    }

    public function tearDown()
    {
        $this->model = null;
    }
}
