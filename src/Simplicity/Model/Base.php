<?php
namespace Simplicity\Model;
class Base
{
    protected $obj;
    protected $pdo;
    static    $table;

    public function __construct($container)
    {
        $this->container = $container;
        $this->obj = array();
        $this->pdo = $container['db'];
        static::$table = (isset(static::$table)) ? static::$table : strtolower(end(explode("\\", get_called_class())));
    }

    public function __set($key, $value)
    {
        $this->obj[$key] = $value;
    }

    public function getbind()
    {
        $returnArray = array();
        if(empty($this->obj)) { return null; }
        foreach($this->obj as $key => $value) {
            $key = ":".$key;
            $value = $value;
            $returnArray[$key] = (string)$value;
        }
        return $returnArray;
    }

    public function getNextID()
    {
        $stmt = $this->pdo->prepare("SHOW TABLE STATUS WHERE Name=:table");
        if($stmt->execute(array(":table"=>static::$table))) {
            $result = $stmt->fetch();
            return $result->Auto_increment;
        } else {
            return false;
        }
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}
