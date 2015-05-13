<?php
namespace SimplicityTest\Library\AnnotationValidator;
use \Simplicity\Library\AnnotationValidator\Conditions;

class ConditionsTest extends \PHPUnit_Framework_TestCase
{
    public function testRequiredCaseSuccess()
    {
        $this->assertTrue(Conditions::required(["a"=>1], "a"));
        $this->assertTrue(Conditions::required(["a"=>false], "a"));
        $this->assertTrue(Conditions::required(["a"=>0], "a"));
    }

    public function testRequiredCaseFailed()
    {
        $this->assertNotTrue(Conditions::required(["b"=>1], "a"));
        $this->assertNotTrue(Conditions::required(["a"=>null],"a"));
        $this->assertNotTrue(Conditions::required(["a"=>""],"a"));
    }

    public function testAlphabetCaseSuccess()
    {
        $this->assertTrue(Conditions::alphabet("a"));
        $this->assertTrue(Conditions::alphabet("abcdefg"));
        $this->assertTrue(Conditions::alphabet("ABcdefG"));
    }

    public function testAlphabetCaseFailed()
    {
        $this->assertNotTrue(Conditions::alphabet("あ"));
        $this->assertNotTrue(Conditions::alphabet("abc12 "));
        $this->assertNotTrue(Conditions::alphabet(" ab"));
    }

    public function testNumericCaseSuccess()
    {
        $this->assertTrue(Conditions::numeric(1));
        $this->assertTrue(Conditions::numeric(0));
        $this->assertTrue(Conditions::numeric("111111"));
        $this->assertTrue(Conditions::numeric(10 * 25));
    }

    public function testNumericCaseFailed()
    {
        $this->assertNotTrue(Conditions::numeric(0.111));
        $this->assertNotTrue(Conditions::numeric(-1));
        $this->assertNotTrue(Conditions::numeric(50000000000000 * 1000000));
    }

    public function testAlphaNumericCaseSuccess()
    {
        $this->assertTrue(Conditions::alphanumric("1a2b3c"));
    }

    public function testAlphaNumericCaseFailed()
    {
        $this->assertNotTrue(Conditions::alphanumric("!ab23"));
    }

    public function testMailCaseSuccess()
    {
        $this->assertTrue(Conditions::mail("test@example.com"));
        $this->assertTrue(Conditions::mail("da.me..@docomo.ne.jp")); //Docomo
    }

    public function testMailCaseFailed()
    {
        // Not RF2822
        $this->assertNotTrue(Conditions::mail("Abc\@def@example.com"));
        $this->assertNotTrue(Conditions::mail("customer/department=shipping@example.com"));
        $this->assertNotTrue(Conditions::mail("!def!xyz%abc@example.com"));
    }

    public function testPhoneCaseSuccess()
    {
        $this->assertTrue(Conditions::phone("090-0000-0000"));
        $this->assertTrue(Conditions::phone("0644441111"));
        $this->assertTrue(Conditions::phone("072-999-9999"));
    }

    public function testPhoneCaseFailed()
    {
        $this->assertNotTrue(Conditions::phone("090-0a00-0000"));
        $this->assertNotTrue(Conditions::phone("0644"));
        $this->assertNotTrue(Conditions::phone("０７２-999-9999"));
    }

    public function testEnumCaseSuccess()
    {
        $this->assertTrue(Conditions::enum(1,"[0,1]"));
        $this->assertTrue(Conditions::enum("a","[a,b,c]"));
        $this->assertTrue(Conditions::enum("abc","[abc,bcd,cde]"));
    }

    public function testEnumCaseFailed()
    {
        $this->assertNotTrue(Conditions::enum(2,"[0,1]"));
        $this->assertNotTrue(Conditions::enum("d","[a,b,c]"));
        $this->assertNotTrue(Conditions::enum("acb","[abc,bcd,cde]"));
    }

    public function testLengthCaseSuccess()
    {
        $this->assertTrue(Conditions::length(12345,"[0,5]"));
        $this->assertTrue(Conditions::length("abcdefghijk","[1,]"));
        $this->assertTrue(Conditions::length("","[,10]"));
        $this->assertTrue(Conditions::length("abcdefghijk","[,]"));
    }

    public function testLengthCaseFailed()
    {
        $this->assertNotTrue(Conditions::length(12345,"[1,4]"));
        $this->assertNotTrue(Conditions::length("abcdefghijk","[,1]"));
        $this->assertNotTrue(Conditions::length("","[1,]"));
    }

    public function testDateCaseSuccess()
    {
        $this->assertTrue(Conditions::date("2015-03-05 12:00:00", "[Y-m-d H:i:s]"));
        $this->assertTrue(Conditions::date(2147483647, "[U]"));
        $this->assertTrue(Conditions::date(date("F"), "[F]"));
        //$this->assertTrue(Conditions::timestamp());
    }
}
