<?php
namespace Simplicity\Library\Http\Session;
interface MySQLModelInterface
{
    public function read($id);
    public function write($id, $data);
    public function destroy($id);
    public function gc($lifetime);
}
