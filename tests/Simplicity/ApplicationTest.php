<?php
namespace SimplicityTest;
use \Simplicity\Application;

/**
 * Class ApplicationTest
 * @package SimplicityTest
 * @group UNIT
 */
class ApplicationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function registorContainer()
    {
        $app = Application::registContainer(array(1));
        $reflection = new \ReflectionClass($app);
        $container = $reflection->getProperty("container");
        $container->setAccessible(true);
        $this->assertEquals([1], $container->getValue());
    }

    /**
     * @test
     */
    public function getInstanceEmptyAurgument()
    {
        $this->assertInstanceOf("stdClass", Application::getInstance("stdClass"));
    }

    /**
     * @test
     */
    public function getInstanceNotEmptyAurgument()
    {
        $this->assertInstanceOf("ArrayObject", Application::getInstance("ArrayObject"));
    }

    /**
     * @test
     */
    public function register()
    {
        Application::registContainer([]);
        Application::register("say", function() {
            return "HelloWorld";
        });
        $this->assertEquals("HelloWorld", Application::get("say"));
    }

    /**
     * @test
     */
    public function registerAlias()
    {
        Application::registerAlias([
            "App" => "Simplicity\Application",
        ]);
        $this->assertTrue(class_exists("App"));
    }
}
