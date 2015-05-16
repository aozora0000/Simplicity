<?php
namespace Simplicity\Library\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Responose
{




    public static function json($object)
    {
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($object, JSON_UNESCAPED_UNICODE);
    }
}
