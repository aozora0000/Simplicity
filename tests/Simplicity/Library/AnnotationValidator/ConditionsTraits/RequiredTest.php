<?php
namespace SimplicityTest\Library\AnnotationValidator\ConditionTraits;
use \Simplicity\Library\AnnotationValidator\ConditionTraits;

class RequiredTest extends \PHPUnit_Framework_TestCase
{
    use ConditionTraits\Common;
    use ConditionTraits\Required;

    /**
     * @test
     */
    public function testRequiredCaseSuccess()
    {
        $this->assertTrue(self::required(["a"=>1], "a"));
        $this->assertTrue(self::required(["a"=>false], "a"));
        $this->assertTrue(self::required(["a"=>0], "a"));
    }

    /**
     * @test
     */
    public function testRequiredCaseFailed()
    {
        $this->assertNotTrue(self::required(["b"=>1], "a"));
        $this->assertNotTrue(self::required(["a"=>null],"a"));
        $this->assertNotTrue(self::required(["a"=>""],"a"));
    }
}
