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
    public function EnumCaseSuccess()
    {
        $this->assertTrue(self::enum(1,"[0,1]"));
        $this->assertTrue(self::enum("a","[a,b,c]"));
        $this->assertTrue(self::enum("abc","[abc,bcd,cde]"));
    }

    /**
     * @test
     */
    public function EnumCaseFailed()
    {
        $this->assertNotTrue(self::enum(2,"[0,1]"));
        $this->assertNotTrue(self::enum("d","[a,b,c]"));
        $this->assertNotTrue(self::enum("acb","[abc,bcd,cde]"));
    }

    /**
     * @test
     */
    public function LengthCaseSuccess()
    {
        $this->assertTrue(self::length(12345,"[0,5]"));
        $this->assertTrue(self::length("abcdefghijk","[1,]"));
        $this->assertTrue(self::length("","[,10]"));
        $this->assertTrue(self::length("abcdefghijk","[,]"));
    }

    /**
     * @test
     */
    public function LengthCaseFailed()
    {
        $this->assertNotTrue(self::length(12345,"[1,4]"));
        $this->assertNotTrue(self::length("abcdefghijk","[,1]"));
        $this->assertNotTrue(self::length("","[1,]"));
    }

    /**
     * @test
     */
    public function RangeCaseSuccess() {
        $this->assertTrue(self::range(1,"[1,4]"));
        $this->assertTrue(self::range(0,"[,4]"));
        $this->assertTrue(self::range(10,"[1,]"));
    }

    /**
     * @test
     */
    public function RangeCaseFailed()
    {
        $this->assertNotTrue(self::range(0,"[1,4]"));
        $this->assertNotTrue(self::range(10,"[,4]"));
        $this->assertNotTrue(self::range(-1,"[1,]"));
    }

    /**
     * @test
     */
    public function MinCaseSuccess()
    {
        $this->assertTrue(self::greaterThan(3,"[2]"));
    }

    /**
     * @test
     */
    public function MinCaseFailed()
    {
        $this->assertNotTrue(self::greaterThan(1,"[2]"));
    }

    /**
     * @test
     */
    public function MaxCaseSuccess()
    {
        $this->assertTrue(self::lessThan(1,"[2]"));
    }

    /**
     * @test
     */
    public function MaxCaseFailed()
    {
        $this->assertNotTrue(self::lessThan(10,"[2]"));
    }

}
