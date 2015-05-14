<?php
namespace SimplicityTest\Library\AnnotationValidator;
use \Simplicity\Library\AnnotationValidator\Compiler;

class CompilerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function buildCaseMethodOnly()
    {
        $docblock = <<< EOM
/**
 * @test
 */
EOM;
        $structs = Compiler::build("test", $docblock);
        $this->assertInstanceOf("Simplicity\Library\AnnotationValidator\Struct", $structs[0]);
        $this->assertEquals("test",          $structs[0]->method);
        $this->assertEquals(null,            $structs[0]->params);
        $this->assertEquals("test is test!", $structs[0]->message);
    }

    /**
     * @test
     */
    public function buildCaseMethodandMessage()
    {
        $docblock = <<< EOM
/**
 * @test    このメッセージはテストです。
 */
EOM;
        $structs = Compiler::build("test", $docblock);
        $this->assertInstanceOf("Simplicity\Library\AnnotationValidator\Struct", $structs[0]);
        $this->assertEquals("test",                         $structs[0]->method);
        $this->assertEquals(null,                           $structs[0]->params);
        $this->assertEquals("このメッセージはテストです。", $structs[0]->message);
    }

    /**
     * @test
     */
    public function buildCaseMethodandParams()
    {
        $docblock = <<< EOM
/**
 * @test [1,2]
 */
EOM;
        $structs = Compiler::build("test", $docblock);
        $this->assertInstanceOf("Simplicity\Library\AnnotationValidator\Struct", $structs[0]);
        $this->assertEquals("test",          $structs[0]->method);
        $this->assertEquals("[1,2]",            $structs[0]->params);
        $this->assertEquals("test is test: [1,2]", $structs[0]->message);
    }

    /**
     * @test
     */
    public function buildCaseMethodandParamsandMessage()
    {
        $docblock = <<< EOM
/**
 * @test [1,2] このメッセージは%sです。
 */
EOM;
        $structs = Compiler::build("test", $docblock);
        $this->assertInstanceOf("Simplicity\Library\AnnotationValidator\Struct", $structs[0]);
        $this->assertEquals("test",          $structs[0]->method);
        $this->assertEquals("[1,2]",            $structs[0]->params);
        $this->assertEquals("このメッセージは%sです。", $structs[0]->message);
    }

    /**
     * @test
     */
    public function buildCaseRequired()
    {
        $docblock = <<< EOM
/**
 * @required
 */
EOM;
        $structs = Compiler::build("test", $docblock);
        $this->assertInstanceOf("Simplicity\Library\AnnotationValidator\Struct", $structs[0]);
        $this->assertEquals("required",          $structs[0]->method);
        $this->assertEquals(null,                $structs[0]->params);
        $this->assertEquals("test is required!", $structs[0]->message);
    }

    /**
     * @test
     */
    public function convertToArray()
    {
        $docblock = <<< EOM
/**
 * @test
 */
EOM;
        $compileArray = array_map(function($line) {
            return trim($line);
        }, Compiler::convertToArray($docblock));
        $this->assertEquals(array("* @test"), $compileArray);
    }

    /**
     * @test
     */
    public function trimLineToArray()
    {
        $this->assertEquals(array("test"), Compiler::trimLineToArray("* @test"));
        $this->assertEmpty(Compiler::trimLineToArray(" *      "));
    }

    /**
     * @test
     */
    public function toStruct()
    {
        $structArray = array(
            "method",
            "[params]",
            "message"
        );
        $struct = Compiler::toStruct("test",$structArray);
        $this->assertInstanceOf("Simplicity\Library\AnnotationValidator\Struct", $struct);
        $this->assertEquals($structArray[0], $struct->method);
        $this->assertEquals($structArray[1], $struct->params);
        $this->assertEquals($structArray[2], $struct->message);
    }
}
