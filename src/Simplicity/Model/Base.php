<?php
namespace Simplicity\Model;
use Simplicity\Library\Classes\Name as ClassName;
class Base
{
    /**
     * バインドパラメータ格納用
     * @var array
     */
    protected $obj;

    /**
     * データベースオブジェクト
     * @var \PDO
     */
    protected $pdo;

    /**
     * テーブル名
     * @var String
     */
    public    $table;

    /**
     * ドライバ名
     * @var String
     */
    protected $driver;

    /**
     * @final
     * @access public
     * @param Pimple\Container $container
     */
    final public function __construct($container)
    {
        $this->container = $container;
        $this->obj = array();
        $this->pdo = $container['db'];
        $this->driver = $this->pdo->getAttribute(\PDO::ATTR_DRIVER_NAME);
        $this->table = (isset($this->table)) ? $this->table : strtolower(ClassName::getTrimNameSpace(get_called_class()));
    }

    /**
     * setter
     * @final
     * @access public
     * @param string $key
     * @param mixed  $value
     */
    final public function __set($key, $value)
    {
        $this->obj[$key] = $value;
    }

    /**
     * $this->objからバインドパラメータを作成する
     * @final
     * @access public
     * @return Array
     */
    final public function getbind()
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

    /**
     * テーブルの次のインクリメントIDを取得する
     * @access public
     * @return integer|false
     */
    public function getNextID()
    {
        switch($this->driver) {
            case "sqlite":
                $stmt = $this->pdo->query(sprintf("SELECT max(id)+1 as `Auto_increment` FROM %s",$this->table)); break;
            default:
                $stmt = $this->pdo->query(sprintf("SHOW TABLE STATUS WHERE Name=%s",$this->table)); break;
        }
        if($stmt) {
            $stmt->execute();
            $result = $stmt->fetch();
            return $result->Auto_increment;
        } else {
            return false;
        }
    }

    /**
     * データベースオブジェクトの破棄
     */
    public function __destruct()
    {
        $this->pdo = null;
    }
}
