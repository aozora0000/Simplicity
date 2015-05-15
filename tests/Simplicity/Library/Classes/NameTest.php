<?php
namespace SimplicityTest\Library\Classes;
use \Simplicity\Library\Classes\Name;

class NameTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function splitClassMethod()
    {
        $name = Name::splitClassMethod("\Simplicity\Library\Classes\Name::splitClassMethod")->getIterator();

        $this->assertObjectHasAttribute("classes", $name);
        $this->assertObjectHasAttribute("methods", $name);
        $this->assertCount(4, $name->classes);
        $this->assertEquals("splitClassMethod", $name->methods[0]);
    }

    /**
     * @test
     */
    public function getFullName()
    {
        $this->assertEquals(get_class(), Name::getFullName(get_class()));
    }

    /**
     * @test
     */
    public function getSeparateName()
    {
        $classes = array(
            "SimplicityTest",
            "Library",
            "Classes",
            "NameTest"
        );
        $this->assertEquals($classes, Name::getSeparateName(get_class()));
    }

    /**
     * @test
     */
    public function getTrimNameSpace()
    {
        $this->assertEquals("NameTest", Name::getTrimNameSpace(get_class()));
    }
}
