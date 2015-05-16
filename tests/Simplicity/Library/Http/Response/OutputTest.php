<?php
namespace SimplicityTest\Library\Http\Response;
use \Simplicity\Library\Http\Response\Output;
use \Simplicity\Library\Http\Response\Header;

class OutputTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function getInstance()
    {
        $this->assertEquals("Illuminate\Http\Response", get_class(Output::getInstance()));
    }

    /**
     * @test
     */
    public function setContent()
    {
        ob_start();
        $output = Output::sendContent("{ test: true }", "application/json", "UTF-8");
        ob_end_clean();
        $output_header = xdebug_get_headers();
        $this->assertEquals("{ test: true }",$output->getContent());
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function setPublic()
    {
        Output::setPublic()->send();
        $output_header = xdebug_get_headers();
        $this->assertContains('Cache-Control: public', $output_header);
    }
}
