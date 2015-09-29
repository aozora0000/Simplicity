<?php
namespace SimplicityTest\Library\AnnotationValidator\ConditionTraits;
use \Simplicity\Library\AnnotationValidator\ConditionTraits\Access;
use \Simplicity\Library\AnnotationValidator\ConditionTraits\Common;

class AccessTest extends \PHPUnit_Framework_TestCase
{
    use Access;
    use Common;

    /**
     * @test
     */
    public function testPhoneCaseSuccess()
    {
        $this->assertTrue(self::phone("090-0000-0000"));
        $this->assertTrue(self::phone("0644441111"));
        $this->assertTrue(self::phone("072-999-9999"));
    }

    /**
     * @test
     */
    public function testPhoneCaseFailed()
    {
        $this->assertNotTrue(self::phone("090-0a00-0000"));
        $this->assertNotTrue(self::phone("0644"));
        $this->assertNotTrue(self::phone("０７２-999-9999"));
    }

    /**
     * @test
     */
    public function testZipcodeCaseSuccess()
    {
        $this->assertTrue(self::zipcode("574-0011"));
        $this->assertTrue(self::zipcode("5300047"));
    }

    /**
     * @test
     */
    public function testZipcodeCaseFailed()
    {
        $this->assertNotTrue(self::zipcode("60644-9998"));
        $this->assertNotTrue(self::zipcode("５７４００１１"));
    }
}
