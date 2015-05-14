<?php
namespace SimplicityTest\Library\AnnotationValidator\ConditionTraits;
use \Simplicity\Library\AnnotationValidator\ConditionTraits;

class GeometoryTest extends \PHPUnit_Framework_TestCase
{
    use ConditionTraits\Common;
    use ConditionTraits\Geometory;

    /**
     * @test
     */
    public function LongitudeCaseSuccess()
    {
        $this->assertTrue(self::longitude(135.52620130000003));
        $this->assertTrue(self::longitude("+135.52620130000003"));
    }

    /**
     * @test
     */
    public function LongitudeCaseFailed()
    {
        $this->assertNotTrue(self::longitude(360.00000000000));
    }

    /**
     * @test
     */
    public function LatitudeCaseSuccess()
    {
        $this->assertTrue(self::latitude(34.6873153));
        $this->assertTrue(self::latitude("+34.6873153"));
    }

    /**
     * @test
     */
    public function LatitudeCaseFailed()
    {
        $this->assertNotTrue(self::latitude(135.52620130000003));
    }

    /**
     * @test
     */
    public function LatlngCaseSuccess()
    {
        $this->assertTrue(self::latlng("+34.6873153, -135.52620130000003"));
    }

    /**
     * @test
     */
    public function LatlngCaseFailed()
    {
        $this->assertNotTrue(self::latlng("-135.52620130000003, +34.6873153"));
    }
}
