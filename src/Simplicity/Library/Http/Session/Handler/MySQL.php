<?php
namespace Simplicity\Library\Http\Session\Handler;
class MySQL implements \SessionHandlerInterface
{
    protected $model;

    public function __construct(MySQLModelInterface $model) {
        $this->model = $model;
    }

    public function open($path, $name)
    {
        return true;
    }

    public function close()
    {
        return true;
    }

    public function read($id)
    {
        return $this->model->read($id);
    }

    public function write($id, $data)
    {
        return $this->model->write($id, $data, time());
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function gc($lifetime)
    {
        return $this->model->gc(time() - $lifetime);
    }
}
