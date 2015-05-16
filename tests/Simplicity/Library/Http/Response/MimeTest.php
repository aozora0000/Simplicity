<?php
namespace SimplicityTest\Library\Http\Response;
use Simplicity\Library\Http\Response\Mime;

class MimeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function getFromExtension()
    {
        $this->assertEquals("image/jpeg", Mime::getFromExtension(".jpeg"));
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function getFromExtensionCaseFailed()
    {
        Mime::getFromExtension(".a");
        $this->assertTrue(false);
    }

    /**
     * @test
     */
    public function getFromPath()
    {
        $this->assertEquals("text/html", Mime::getFromPath(realpath(__FILE__)));
        $this->assertEquals("image/png", Mime::getFromPath("http://cdn.qiita.com/assets/siteid-reverse-1949e989f9d8b2f6fad65a57292b2b01.png"));
    }
}
