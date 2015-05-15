<?php
namespace Simplicity\Model;
/**
 * Example Table Schema
 * $id          integer       PRIMARY AUTOINCREMENT
 * $created_at  timestamp
 */
class Example extends Base
{
    /**
     * 収入例登録
     * @return boolean
     */
    public function get()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `example` WHERE id=:id LIMIT 1");
        $stmt->execute($this->getbind());
        return $stmt->fetch();
    }
}
