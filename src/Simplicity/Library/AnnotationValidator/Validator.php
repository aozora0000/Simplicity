<?php
namespace Simplicity\Library\AnnotationValidator;
use Simplicity\Library\AnnotationValidator\Behavior;
use Simplicity\Library\AnnotationValidator\Conditions;
use Simplicity\Library\AnnotationValidator\Tree;
use \ReflectionClass;
use \Exception;

class Validator
{
    /**
     * @var ReflectionClass
     */
    protected $reflaction;

    /**
     * ValidateInterface内のプロパティ名
     * @var Array
     */
    protected $prop_keys;

    /**
     * プロパティ名＋アノテーション
     * @var Array
     */
    protected $tree;

    /**
     * エラーメッセージ格納用
     * @var Array
     */
    protected $messages;

    /**
     * エラー判定用
     * @var boolean
     */
    public $iserror = false;

    public function setValid(Behavior $valid)
    {
        $this->reflaction = new ReflectionClass($valid);
        $this->prop_keys = array_keys((array)$valid);

        foreach($this->prop_keys as $key) {
            $this->tree[$key] = Compiler::build($key, $this->reflaction->getProperty($key)->getDocComment());
        }
    }

    public function getMessages()
    {
        return $this->messages;
    }

    public function __toString()
    {
        return join("\n", $this->messages);
    }

    public function validate(Array $params)
    {
        $params_keys = array_keys($params);

        foreach($this->tree as $key=>$valids) {

            foreach($valids as $valid) {

                $method     = $valid->method;
                $condition  = $valid->params;
                $message    = $valid->message;

                // メソッドがrequiredの場合
                if($valid->isRequired()) {
                    if(!Conditions::required($params, $key)) {
                        $this->adderror($message);
                    }
                }

                // パラメータ内にValidateプロパティ名が存在する場合
                elseif(in_array($key, $params_keys)) {

                    // AnnotationValidator\Conditionsにメソッドが存在する場合
                    if(method_exists("Simplicity\\Library\\AnnotationValidator\\Conditions", $method)) {

                        //引数無しの場合
                        if($condition) {
                            if(!Conditions::$method($params[$key], $condition)) {
                                $message = (preg_match("/\%(d|s|f)/", $message)) ? sprintf($message, $condition) : $message;
                                $this->adderror($message);
                            }
                        }
                        //引数無しの場合
                        else {
                            if(!Conditions::$method($params[$key])) {
                                $this->adderror($message);
                            }
                        }
                    }

                    // 独自メソッド・クラスの場合
                    else {
                        //クラス::メソッドの場合
                        if(strpos($method, "::") !== false) {
                            list($class ,$function) = explode("::", $method);
                            //引数有りの場合
                            if($condition) {
                                if(!$class::$function($params[$key], $condition)) {
                                    $message = (preg_match("/\%(d|s|f)/", $message)) ? sprintf($message, $condition) : $message;
                                    $this->adderror($message);
                                }
                            }

                            //引数無しの場合
                            else {
                                if(!$class::$function($params[$key])) {
                                    $this->adderror($message);
                                }
                            }
                        }
                        //関数の場合
                        else {
                            //引数有りの場合
                            if($condition) {
                                if(!$method($params[$key])) {
                                    $this->adderror($message);
                                }
                            }

                            //引数無しの場合
                            else {
                                if(!$method($params[$key], $condition)) {
                                    $message = (preg_match("/\%(d|s|f)/", $message)) ? sprintf($message, $condition) : $message;
                                    $this->adderror($message);
                                }
                            }
                        }
                    }
                }

                // パラメータ内にValidateプロパティ名が存在しない場合
                else {

                }
            }
        }
        return (bool)!$this->iserror;
    }

    public function adderror($message)
    {
        $this->iserror = true;
        $this->messages[] = $message;
    }
}
