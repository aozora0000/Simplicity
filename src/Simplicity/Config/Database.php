<?php
namespace Simplicity\Config;

class Database
{
    public function getInstance()
    {
        return (object)array(
            "dsn"  => "mysql:host=localhost;dbname=example;charset=utf8",
            "user" => "root",
            "pass" => ""
        );
    }

    public function getMigrateInstance()
    {
        return (object)array(
            "dsn"  => "mysql:host=localhost;dbname=example;charset=utf8",
            "user" => "root",
            "pass" => ""
        );
    }
}
