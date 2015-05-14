<?php
namespace SimplicityTest\Library\AnnotationValidator\ConditionTraits;
use \Simplicity\Library\AnnotationValidator\ConditionTraits;

class CommonTest extends \PHPUnit_Framework_TestCase
{
    use ConditionTraits\Common;

    /**
     * @test
     */
    public function testTrimCondition()
    {
        $this->assertEquals("test", self::trimCondition("[test]"));
    }

    /**
     * @test
     */
    public function testTrimStackCondition()
    {
        $assertArray = [1,2,3];
        $this->assertEquals($assertArray, self::trimStackCondition("[ 1, 2, 3]"));
    }

    /**
     * @test
     */
    public function testIntStackCondition()
    {
        $assertArray = [1,2,3];
        $this->assertEquals($assertArray, self::intStackCondition("[ 1.0, 2.2, 3]"));
    }
}
