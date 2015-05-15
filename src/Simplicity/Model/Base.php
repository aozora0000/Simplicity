<?php
namespace Simplicity\Model;
use Simplicity\Library\Classes\Name as ClassName;
class Base
{
    protected $obj;
    protected $pdo;
    public    $table;
    protected $driver;

    public function __construct($container)
    {
        $this->container = $container;
        $this->obj = array();
        $this->pdo = $container['db'];
        $this->driver = $this->pdo->getAttribute(\PDO::ATTR_DRIVER_NAME);
        $this->table = (isset($this->table)) ? $this->table : strtolower(ClassName::getTrimNameSpace(get_called_class()));
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
        switch($this->driver) {
            case "sqlite":
                $stmt = $this->pdo->query(sprintf("SELECT max(id)+1 as `Auto_increment` FROM %s",$this->table)); break;
            default:
                $stmt = $this->pdo->query(sprintf("SHOW TABLE STATUS WHERE Name=%s",$this->table)); break;
        }
        if($stmt->execute()) {
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
