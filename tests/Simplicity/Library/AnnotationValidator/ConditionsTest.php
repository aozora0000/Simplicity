<?php
namespace SimplicityTest\Library\AnnotationValidator;
use \Simplicity\Library\AnnotationValidator\Conditions;

class ConditionsTest extends \PHPUnit_Framework_TestCase
{
    protected $traits;

    public function setUp()
    {
        $reflection = new \ReflectionClass(new Conditions);
        $this->traits = $reflection->getTraitNames();
    }

    /**
     * @test
     */
    public function AccessTraitCalled()
    {
        $this->assertContains("Simplicity\Library\AnnotationValidator\ConditionTraits\Access", $this->traits);
    }

    /**
     * @test
     */
    public function CommonTraitCalled()
    {
        $this->assertContains("Simplicity\Library\AnnotationValidator\ConditionTraits\Common", $this->traits);
    }

    /**
     * @test
     */
    public function DateTraitCalled()
    {
        $this->assertContains("Simplicity\Library\AnnotationValidator\ConditionTraits\Date", $this->traits);
    }

    /**
     * @test
     */
    public function GeometoryTraitCalled()
    {
        $this->assertContains("Simplicity\Library\AnnotationValidator\ConditionTraits\Geometory", $this->traits);
    }

    /**
     * @test
     */
    public function OperatorTraitCalled()
    {
        $this->assertContains("Simplicity\Library\AnnotationValidator\ConditionTraits\Operator", $this->traits);
    }

    /**
     * @test
     */
    public function RequiredTraitCalled()
    {
        $this->assertContains("Simplicity\Library\AnnotationValidator\ConditionTraits\Required", $this->traits);
    }

    /**
     * @test
     */
    public function StringTraitCalled()
    {
        $this->assertContains("Simplicity\Library\AnnotationValidator\ConditionTraits\Strings", $this->traits);
    }

    /**
     * @test
     */
    public function WebTraitCalled()
    {
        $this->assertContains("Simplicity\Library\AnnotationValidator\ConditionTraits\Web", $this->traits);
    }
}
