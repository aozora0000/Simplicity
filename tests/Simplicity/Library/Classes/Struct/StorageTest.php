<?php
namespace SimplicityTest\Library\Classes\Struct;
use \Simplicity\Library\Classes\Struct\Storage;

class StorageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function getter()
    {
        $storage = new Storage;
        $storage->classes = new \ArrayObject;
        $this->assertEquals("ArrayObject",get_class($storage->classes));
        $this->assertEmpty($storage->classes);
    }
}
