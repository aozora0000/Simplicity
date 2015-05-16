<?php
namespace SimplicityTest\Library\Http\Request;
use \Simplicity\Library\Http\Request\File;
class FileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function get()
    {
        $_FILES['test1'] = [
            "name" => "test.txt",
            "type" => "plain/text",
            "size" => 1,
            "tmp_name" => realpath(dirname(__FILE__)."/../../../../files/test.txt"),
            "error" => UPLOAD_ERR_OK
        ];
        $_FILES['test2'] = [
            "name" => "test.txt",
            "type" => "plain/text",
            "size" => 1,
            "tmp_name" => realpath(dirname(__FILE__)."/../../../../files/test.txt"),
            "error" => UPLOAD_ERR_OK
        ];
        $file = File::get();
        $this->assertCount(2, $file);
        $this->assertEquals("Symfony\Component\HttpFoundation\File\UploadedFile", get_class($file['test1']));
        $this->assertEquals("Symfony\Component\HttpFoundation\File\UploadedFile", get_class($file['test2']));
    }
}
