<?php
use Simplicity\Library\Http\Session\Cookie;
// $int = Cookie::get("test1", 1);
// Cookie::expire(time() + 1800);
// Cookie::set("test1", $int + 1);
// Cookie::set("test2", $int + 1);
// Cookie::commit();
Cookie::expire(time() + 3600);
$int = Cookie::get("test", 1);
Cookie::set("test", $int + 1)->commit();
var_dump($int);
