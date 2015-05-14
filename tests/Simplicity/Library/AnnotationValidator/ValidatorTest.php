<?php
namespace SimplicityTest\Library\AnnotationValidator;
use \Simplicity\Library\AnnotationValidator\Validator;
use \Simplicity\Validate\Example;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function example()
    {
        $params = array(
            "id" => null,
            "created_at" => date("Y-m-d H:i:s"),
            "true" => true
        );

        $validator = new Validator;
        $validator->setValid(new Example);
        $validator->validate($params);

        $this->assertNotEmpty($validator->getMessages());
        ob_start();
        echo $validator;
        $message = ob_get_contents();
        ob_end_clean();
        $this->assertNotEmpty($message);
    }
}
