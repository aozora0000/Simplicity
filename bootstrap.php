<?php
/**
 * パス設定
 */
define("ROOT_DIR",   realpath(dirname(__FILE__)."/"));
define("APP_DIR",    ROOT_DIR."/src/Simplicity/");
define("VENDOR_DIR", APP_DIR."../../vendor/");
define("ADMIN_DIR",  ROOT_DIR."admin/");

/**
 * 暗号化設定(COOKIE/SESSION)
 */
define("__SESSION__",   "SIMPLICITY_SESSSION");
define("__COOKIE__",    "SIMPLICITY_COOKIE");
define("__HOST__",      (isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : "localhost:8080");
define("__SECURE__",    false);
define("CRYPT_HASH", "8ff770d2c4c3d56b803709e07eeb8490242ffebb2a7ca7e2f24ca6c5");

/**
 * コンテナ・オートローダー
 */
$require = require(VENDOR_DIR."autoload.php");
$container = new Pimple\Container;

/**
 * データベース関連
 */
$container['db.conf'] = function() use ($container) {
    $config = new Simplicity\Config\Database;
    return $config->getInstance();
};

$container['db'] = function() use ($container) {
    $config = $container['db.conf'];
    $pdo = new PDO($config->dsn, $config->user, $config->pass);
    $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
    return $pdo;
};

/**
 * バリデーター
 */
$container['validator'] = function () use ($container) {
    return new Simplicity\Library\AnnotationValidator;
};

/**
 * リクエスト
 */
$container['request'] = function () use ($container) {
    return new Simplicity\Request\Request;
};


/**
 * メーラー関連
 */
$container['mailer.conf'] = function() use ($container) {
    $config = new Simplicity\Config\Mail;
    return $config->getInstance();
};

$container['mailer'] = function() use ($container) {
    return Swift_Mailer::newInstance(Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs'));
};

$container['message'] = function() use ($container) {
    $config = $container['mailer.conf'];
    return Swift_message::newInstance()->setSubject($config->subject)->setFrom($config->from);
};

$container['attachment'] = function() use ($container) {
    return new Swift_Attachment;
};

/**
 * テンプレートエンジン関連
 */
$container['view'] = function() use ($container) {
    \Twig_Autoloader::register();
    $loader = new Twig_Loader_Filesystem(APP_DIR.'.templates/pc/');
    return new \Twig_Environment($loader);
};

/**
 * 要コンテナアプリケーション設定
 */
Simplicity\Loader::registContainer($container);
