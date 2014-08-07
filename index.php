<?php
error_reporting(7);

// change the following paths if necessary
$pwd = dirname(__FILE__);
$yii=$pwd.'/../framework/yii.php';
$config=$pwd.'/protected/config/main.php';
require_once $pwd.'/protected/function.common.php';
define('IS_PRODUCT', $server[$_SERVER['SERVER_ADDR']]);
error_reporting(IS_PRODUCT ? 0 : 7);
// remove the following lines when in production mode
//var_dump($_REQUEST,$_SERVER);
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
date_default_timezone_set('Asia/Hong_Kong');
require_once($yii);
Yii::createWebApplication($config)->run();
