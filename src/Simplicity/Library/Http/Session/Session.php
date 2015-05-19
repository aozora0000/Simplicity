<?php
namespace Simplicity\Library\Http\Session;
use \Closure;

class Session
{
    public static function register(\SessionHandlerInterface $handler)
    {
        try {
            return (
                session_set_save_handler(
                    array($handler, 'open'),
                    array($handler, 'close'),
                    array($handler, 'read'),
                    array($handler, 'write'),
                    array($handler, 'destroy'),
                    array($handler, 'gc')
                ) &&
                register_shutdown_function('session_write_close') &&
                session_start()
            );
        } catch (\Exception $e) {
            throw new \Exception("セッションハンドラーの登録に失敗しました。");
        }
    }
}
