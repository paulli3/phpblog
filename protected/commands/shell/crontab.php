<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

// change the following paths if necessary
$pwd = dirname(__FILE__)."/../../../";
$yii=$pwd.'/../framework/yii.php';
$config=$pwd.'/protected/config/console.php';


require_once $pwd.'/protected/function.common.php';
// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
error_reporting(7);
//require_once $pwd.'/protected/function.common.php';
require_once($yii);

Yii::createConsoleApplication($config)->run();

