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
    public function OrContainCaseSuccess()
    {
        $this->assertTrue(self::orContain("abc","[abcde,edfgh,xyz]"));
    }

    /**
     * @test
     */
    public function OrContainCaseFailed()
    {
        $this->assertNotTrue(self::orContain("abc","[xyz,edfg,ab]"));
    }

    /**
     * @test
     */
    public function AndContainCaseSuccess()
    {
        $this->assertTrue(self::andContain("abc","[abced,1abcd,!kdtabcd]"));
    }

    /**
     * @test
     */
    public function AndContainCaseFailed()
    {
        $this->assertNotTrue(self::andContain("abc","[abced,1abcd,!kdtbcd]"));
    }

    /**
     * @test
     */
    public function AlphabetCaseSuccess()
    {
        $this->assertTrue(self::alphabet("a"));
        $this->assertTrue(self::alphabet("abcdefg"));
        $this->assertTrue(self::alphabet("ABcdefG"));
    }

    /**
     * @test
     */
    public function AlphabetCaseFailed()
    {
        $this->assertNotTrue(self::alphabet("あ"));
        $this->assertNotTrue(self::alphabet("abc12 "));
        $this->assertNotTrue(self::alphabet(" ab"));
    }

    /**
     * @test
     */
    public function NumericCaseSuccess()
    {
        $this->assertTrue(self::numeric(1));
        $this->assertTrue(self::numeric(0));
        $this->assertTrue(self::numeric("111111"));
        $this->assertTrue(self::numeric(10 * 25));
    }

    /**
     * @test
     */
    public function NumericCaseFailed()
    {
        $this->assertNotTrue(self::numeric(0.111));
        $this->assertNotTrue(self::numeric(-1));
        $this->assertNotTrue(self::numeric(50000000000000 * 1000000));
    }

    /**
     * @test
     */
    public function AlphaNumericCaseSuccess()
    {
        $this->assertTrue(self::alphanumric("1a2b3c"));
    }

    /**
     * @test
     */
    public function AlphaNumericCaseFailed()
    {
        $this->assertNotTrue(self::alphanumric("!ab23"));
    }

    /**
     * @test
     */
    public function ZenkakuCaseSuccess()
    {
        $this->assertTrue(self::zenkaku("あいうえお"));
        $this->assertTrue(self::zenkaku("漢字"));
        $this->assertTrue(self::zenkaku("ＡＢＣＥＤ"));
        $this->assertTrue(self::zenkaku("！？＜＋＝"));
    }

    /**
     * @test
     */
    public function ZenkakuCaseFailed()
    {
        $this->assertNotTrue(self::zenkaku("123"));
        $this->assertNotTrue(self::zenkaku("aiueo"));
        $this->assertNotTrue(self::zenkaku("!?/.de"));
    }

    /**
     * @test
     */
    public function HankakuCaseSuccess()
    {
        $this->assertTrue(self::hankaku("123"));
        $this->assertTrue(self::hankaku("aiueo"));
        $this->assertTrue(self::hankaku("!?/.de"));
    }

    /**
     * @test
     */
    public function HankakuCaseFailed()
    {
        $this->assertNotTrue(self::hankaku("あいうえお"));
        $this->assertNotTrue(self::hankaku("漢字"));
        $this->assertNotTrue(self::hankaku("ＡＢＣＥＤ"));
        $this->assertNotTrue(self::hankaku("！？＜＋＝"));
    }
}
