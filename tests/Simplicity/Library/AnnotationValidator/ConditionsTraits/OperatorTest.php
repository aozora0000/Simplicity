<?php
namespace SimplicityTest\Library\AnnotationValidator\ConditionTraits;
use \Simplicity\Library\AnnotationValidator\ConditionTraits;

class Dummy
{
    use ConditionTraits\Common;
    use ConditionTraits\Operator;
}

class OperatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function EnumCaseSuccess()
    {
        $this->assertTrue(Dummy::enum(1,"[0,1]"));
        $this->assertTrue(Dummy::enum("a","[a,b,c]"));
        $this->assertTrue(Dummy::enum("abc","[abc,bcd,cde]"));
    }

    /**
     * @test
     */
    public function EnumCaseFailed()
    {
        $this->assertNotTrue(Dummy::enum(2,"[0,1]"));
        $this->assertNotTrue(Dummy::enum("d","[a,b,c]"));
        $this->assertNotTrue(Dummy::enum("acb","[abc,bcd,cde]"));
    }

    /**
     * @test
     */
    public function LengthCaseSuccess()
    {
        $this->assertTrue(Dummy::length(12345,"[0,5]"));
        $this->assertTrue(Dummy::length("abcdefghijk","[1,]"));
        $this->assertTrue(Dummy::length("","[,10]"));
        $this->assertTrue(Dummy::length("abcdefghijk","[,]"));
    }

    /**
     * @test
     */
    public function LengthCaseFailed()
    {
        $this->assertNotTrue(Dummy::length(12345,"[1,4]"));
        $this->assertNotTrue(Dummy::length("abcdefghijk","[,1]"));
        $this->assertNotTrue(Dummy::length("","[1,]"));
    }

    /**
     * @test
     */
    public function RangeCaseSuccess() {
        $this->assertTrue(Dummy::range(1,"[1,4]"));
        $this->assertTrue(Dummy::range(0,"[,4]"));
        $this->assertTrue(Dummy::range(10,"[1,]"));
        $this->assertTrue(Dummy::range(1,"[,]"));
    }

    /**
     * @test
     */
    public function RangeCaseFailed()
    {
        $this->assertNotTrue(Dummy::range(0,"[1,4]"));
        $this->assertNotTrue(Dummy::range(10,"[,4]"));
        $this->assertNotTrue(Dummy::range(-1,"[1,]"));
    }

    /**
     * @test
     */
    public function greaterThanCaseSuccess()
    {
        $this->assertTrue(Dummy::greaterThan(3,"[2]"));
    }

    /**
     * @test
     */
    public function greaterThanCaseFailed()
    {
        $this->assertNotTrue(Dummy::greaterThan(1,"[2]"));
    }

    /**
     * @test
     */
    public function greaterThanOrEqualCaseSuccess()
    {
        $this->assertTrue(Dummy::greaterThanOrEqual(2,"[2]"));
    }

    /**
     * @test
     */
    public function greaterThanOrEqualCaseFailed()
    {
        $this->assertNotTrue(Dummy::greaterThanOrEqual(1,"[2]"));
    }

    /**
     * @test
     */
    public function lessThanCaseSuccess()
    {
        $this->assertTrue(Dummy::lessThan(1,"[2]"));
    }

    /**
     * @test
     */
    public function lessThanCaseFailed()
    {
        $this->assertNotTrue(Dummy::lessThan(10,"[2]"));
    }

    /**
     * @test
     */
    public function lessThanOrEqualCaseSuccess()
    {
        $this->assertTrue(Dummy::lessThanOrEqual(2,"[2]"));
    }

    /**
     * @test
     */
    public function lessThanOrEqualCaseFailed()
    {
        $this->assertNotTrue(Dummy::lessThanOrEqual(10,"[2]"));
    }

}
