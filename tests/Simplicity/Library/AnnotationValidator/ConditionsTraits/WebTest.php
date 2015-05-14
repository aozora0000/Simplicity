<?php
namespace SimplicityTest\Library\AnnotationValidator\ConditionTraits;
use \Simplicity\Library\AnnotationValidator\ConditionTraits;

class WebTest extends \PHPUnit_Framework_TestCase
{
    use ConditionTraits\Common;
    use ConditionTraits\Web;

    /**
     * @test
     */
    public function testMailCaseSuccess()
    {
        $this->assertTrue(self::mail("test@example.com"));
        $this->assertTrue(self::mail("da.me..@docomo.ne.jp")); //Docomo
    }

    /**
     * @test
     */
    public function testMailCaseFailed()
    {
        // Not RF2822
        $this->assertNotTrue(self::mail("Abc\@def@example.com"));
        $this->assertNotTrue(self::mail("customer/department=shipping@example.com"));
        $this->assertNotTrue(self::mail("!def!xyz%abc@example.com"));
    }
}
