<?php
namespace Simplicity\Model;
use \Simplicity\Library\Http\Session\MySQLModelInterface as SessionInterface;

class Session extends Base implements SessionInterface
{
    public function read($id)
    {
        $this->session_id = $id;
        $stmt = $this->pdo->prepare("SELECT session_data FROM `session` WHERE session_id=:session_id LIMIT 1");
        if($stmt->execute($this->getbind())) {
            $row = $stmt->fetch();
            return $row->session_data;
        } else {
            return "";
        }
    }

    public function write($id, $data)
    {
        $this->session_id = $id;
        $this->updated = time();
        $this->session_data = $data;

        $stmt = $this->pdo->prepare(
            "INSERT INTO `session` (session_id, session_updated, session_data) VALUES(:session_id, :session_updated, session_data)
             ON DUPLICATE KEY UPDATE session_updated=:session_updated, session_data=:session_data"
        );
        return $stmt->execute($this->getbind());
    }

    public function destroy($id)
    {
        $this->session_id = $id;
        $stmt = $this->pdo->prepare("DELETE FROM `session` WHERE session_id=:id");
        return $stmt->execute($this->getbind());
    }

    public function gc($limit)
    {
        $this->session_limit = $limit;
        $stmt = $this->pdo->prepare("DELETE FROM `session` WHERE session_updated < :session_limit");
        return $stmt->execute($this->getbind());
    }
}
