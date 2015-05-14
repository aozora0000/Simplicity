<?php
namespace SimplicityTest\Library\AnnotationValidator\ConditionTraits;
use \Simplicity\Library\AnnotationValidator\ConditionTraits;

class DateTest extends \PHPUnit_Framework_TestCase
{
    use ConditionTraits\Date;
    use ConditionTraits\Common;
    /**
     * @test
     */
    public function testDateCaseSuccess()
    {
        $this->assertTrue(self::date("2015-03-05 12:00:00", "[Y-m-d H:i:s]"));
        $this->assertTrue(self::date(2147483647, "[U]"));
        $this->assertTrue(self::date(date("F"), "[F]"));
    }
}
