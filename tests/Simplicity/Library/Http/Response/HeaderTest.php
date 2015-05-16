<?php
namespace SimplicityTest\Library\Http\Response;
use Simplicity\Library\Http\Response\Header;

class HeaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @runInSeparateProcess
     */
    public function noCache()
    {
        Header::noCache();
        $output_header = xdebug_get_headers();
        $this->assertContains('PRAGMA: no-cache', $output_header);
        $this->assertContains('Cache-Control: no-cache, private', $output_header);
    }
}
