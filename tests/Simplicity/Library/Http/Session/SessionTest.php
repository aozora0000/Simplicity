<?php
/**
 * Created by PhpStorm.
 * User: aozora0000
 * Date: 2015/08/25
 * Time: 13:15
 */

namespace SimplicityTest\Library\Http\Session;


use Simplicity\Library\Http\Session\Handler\File;
use Simplicity\Library\Http\Session\Session;
use Illuminate\Filesystem\Filesystem;

/**
 * Class SessionTest
 * @package SimplicityTest\Library\Http\Session
 * @group Session
 */
class SessionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @runInSeparateProcess
     */
    public function registerSucsessCase()
    {
        $session = Session::register(new File(new Filesystem, STORAGE_PATH));
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function registerFailedCase()
    {

    }

}