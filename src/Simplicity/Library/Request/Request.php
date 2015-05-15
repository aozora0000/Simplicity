<?php
namespace Simplicity\Library\Request;
class Request
{
    protected $request;

    public function __construct()
    {
        $this->request = $_REQUEST;
    }

    public function get($name, $default = null)
    {
        if(isset($this->request[$name])) {
            return $this->request[$name];
        } else {
            return $default;
        }
    }

    public function getAll()
    {
        return (object)$this->request;
    }

    public static function is_get()
    {
        return ($_SERVER["REQUEST_METHOD"] === "GET");
    }

    public static function is_post()
    {
        return ($_SERVER["REQUEST_METHOD"] === "POST");
    }

    public static function is_ajax()
    {
        return (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
        );
    }
}
