<?php
namespace SimplicityTest\Library\Http\Response;
use Simplicity\Library\Http\Response\Json;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function send()
    {
        $json = new Json;
        $json->test = true;
        $this->assertTrue($json->test);
        $json->setObject(['test'=>false]);
        ob_start();
        $output = $json->send();
        ob_end_clean();
        $json->__destruct();
        $output_header = xdebug_get_headers();
        $this->assertEquals('{"test":false}',$output->getContent());
    }
}
