<?php
namespace SimplicityTest;
use \Simplicity\Loader;

class LoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testRegistorContainer()
    {
        Loader::registContainer(array(1));
        $this->assertNotEmpty(Loader::$container);
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetInstanceEmptyAurgument()
    {
        $this->assertInstanceOf("stdClass", Loader::getInstance("stdClass"));
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetInstanceNotEmptyAurgument()
    {
        Loader::registContainer(array(1));
        $this->assertInstanceOf("ArrayObject", Loader::getInstance("ArrayObject"));
    }
}
