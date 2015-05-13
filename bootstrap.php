<?php
// パス設定
define("ROOT_DIR",   realpath(dirname(__FILE__)."/../"));
define("APP_DIR",    ROOT_DIR."/include/");
define("VENDOR_DIR", APP_DIR."/vendor/");
define("ADMIN_DIR",  ROOT_DIR."/admin/");

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
