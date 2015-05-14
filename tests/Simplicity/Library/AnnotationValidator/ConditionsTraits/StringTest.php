<?php
namespace SimplicityTest\Library\AnnotationValidator\ConditionTraits;
use \Simplicity\Library\AnnotationValidator\ConditionTraits;

class StringTest extends \PHPUnit_Framework_TestCase
{
    use ConditionTraits\Common;
    use ConditionTraits\String;
    /**
     * @test
     */
    public function testAlphabetCaseSuccess()
    {
        $this->assertTrue(self::alphabet("a"));
        $this->assertTrue(self::alphabet("abcdefg"));
        $this->assertTrue(self::alphabet("ABcdefG"));
    }

    /**
     * @test
     */
    public function testAlphabetCaseFailed()
    {
        $this->assertNotTrue(self::alphabet("あ"));
        $this->assertNotTrue(self::alphabet("abc12 "));
        $this->assertNotTrue(self::alphabet(" ab"));
    }

    /**
     * @test
     */
    public function testNumericCaseSuccess()
    {
        $this->assertTrue(self::numeric(1));
        $this->assertTrue(self::numeric(0));
        $this->assertTrue(self::numeric("111111"));
        $this->assertTrue(self::numeric(10 * 25));
    }

    /**
     * @test
     */
    public function testNumericCaseFailed()
    {
        $this->assertNotTrue(self::numeric(0.111));
        $this->assertNotTrue(self::numeric(-1));
        $this->assertNotTrue(self::numeric(50000000000000 * 1000000));
    }

    /**
     * @test
     */
    public function testAlphaNumericCaseSuccess()
    {
        $this->assertTrue(self::alphanumric("1a2b3c"));
    }

    /**
     * @test
     */
    public function testAlphaNumericCaseFailed()
    {
        $this->assertNotTrue(self::alphanumric("!ab23"));
    }
}
