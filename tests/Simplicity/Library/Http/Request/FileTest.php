<?php
namespace SimplicityTest\Library\Http\Request;
use \Simplicity\Library\Http\Request\File;

/**
 * Class FileTest
 * @package SimplicityTest\Library\Http\Request
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class FileTest extends \PHPUnit_Framework_TestCase
{
    public function FileDataProvider()
    {
        return [
            "test1" => [
                "name" => "test.txt",
                "type" => "plain/text",
                "size" => 1,
                "tmp_name" => realpath(dirname(__FILE__)."/../../../../files/test.txt"),
                "error" => UPLOAD_ERR_OK
            ],
            "test2" => [
                "name" => "test.txt",
                "type" => "plain/text",
                "size" => 1,
                "tmp_name" => realpath(dirname(__FILE__)."/../../../../files/test.txt"),
                "error" => UPLOAD_ERR_OK
            ]
        ];
    }

    /**
     * @test
     * @runInSeparateProcess
     * @dataProvider FileDataProvider
     */
    public function get($files)
    {
        var_dump($files);exit;
        $_FILES = $files;
        var_dump($_FILES);exit;
        $file = File::get();
        $this->assertCount(2, $file);
        $this->assertEquals("Symfony\Component\HttpFoundation\File\UploadedFile", get_class($file['test1']));
        $this->assertEquals("Symfony\Component\HttpFoundation\File\UploadedFile", get_class($file['test2']));
    }

    /**
     * @test
     * @runInSeparateProcess
     * @dataProvider FileDataProvider
     */
    public function map($files)
    {
        $_FILES = $files;
        $files = File::map(function($key, $file) {
            return $key;
        });
        $this->assertEquals(array("test1","test2"), $files);
    }
}
