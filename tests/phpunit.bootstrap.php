<?php
require dirname(__FILE__)."/../vendor/autoload.php";


function testValid($params, $condition = null)
{
    return true;
}

function testVaildFailed($parasm, $condition = null)
{
    return false;
}

class TestContainer
{
    public static function getInstance()
    {
        $container = new Pimple\Container;
        $container['db'] = function() {
            $pdo = new \PDO("sqlite::memory:", null, null,array(
                \PDO::ATTR_PERSISTENT => true,
            ));
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            $pdo->exec("create table example(id int auto_increment)");
            $pdo->exec("create table base(id int auto_increment)");
            $pdo->exec("Insert Into base (id) values(1)");
            $pdo->exec("Insert Into example (id) values(1)");
            return $pdo;
        };
        return $container;
    }
}
