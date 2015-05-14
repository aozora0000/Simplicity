<?php
namespace SimplicityTest\Library\AnnotationValidator\ConditionTraits;
use \Simplicity\Library\AnnotationValidator\ConditionTraits;

class OperatorTest extends \PHPUnit_Framework_TestCase
{
    use ConditionTraits\Common;
    use ConditionTraits\Operator;

    /**
     * @test
     */
    public function testEnumCaseSuccess()
    {
        $this->assertTrue(self::enum(1,"[0,1]"));
        $this->assertTrue(self::enum("a","[a,b,c]"));
        $this->assertTrue(self::enum("abc","[abc,bcd,cde]"));
    }

    /**
     * @test
     */
    public function testEnumCaseFailed()
    {
        $this->assertNotTrue(self::enum(2,"[0,1]"));
        $this->assertNotTrue(self::enum("d","[a,b,c]"));
        $this->assertNotTrue(self::enum("acb","[abc,bcd,cde]"));
    }

    /**
     * @test
     */
    public function testLengthCaseSuccess()
    {
        $this->assertTrue(self::length(12345,"[0,5]"));
        $this->assertTrue(self::length("abcdefghijk","[1,]"));
        $this->assertTrue(self::length("","[,10]"));
        $this->assertTrue(self::length("abcdefghijk","[,]"));
    }

    /**
     * @test
     */
    public function testLengthCaseFailed()
    {
        $this->assertNotTrue(self::length(12345,"[1,4]"));
        $this->assertNotTrue(self::length("abcdefghijk","[,1]"));
        $this->assertNotTrue(self::length("","[1,]"));
    }
}
