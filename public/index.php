<?php

/** Settings */
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
ini_set('error_reporting', E_ALL ^ E_NOTICE);


/** Defined */
// Define path to current directory
define('BASE_PATH', dirname(__FILE__));

// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(BASE_PATH . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));


/** Including */
require_once(dirname(__FILE__) . '/../../vendor/autoload.php');

if(APPLICATION_ENV == 'development'){
    require_once(dirname(__FILE__). '/mydebug.php');
}


/** Zend_Application */
//require_once 'Zend/Application.php';
$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV, true);
$config->merge(new Zend_Config_Ini(APPLICATION_PATH . '/configs/routes.ini', null, array()));
$config->merge(new Zend_Config_Ini(APPLICATION_PATH . '/configs/allowedurl.ini'));


// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    $config
);

$application->bootstrap()
    ->run();