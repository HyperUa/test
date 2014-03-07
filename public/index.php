<?php

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
ini_set('error_reporting', E_ALL ^ E_NOTICE);


require_once(dirname(__FILE__) . '/../../vendor/autoload.php');


function d($text)
{
    dd($text);
    die('');
}

function dd($text)
{
    echo '<pre>';
    var_dump($text);
    echo '</pre>';
}

define('BASE_PATH', dirname(__FILE__));

// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

define('APPLICATION_ENV', 'production');

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

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