<?php
require_once(dirname(__FILE__). '/../../vendor/autoload.php');


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

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
ini_set('error_reporting', E_ALL ^ E_NOTICE);


// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

$application->bootstrap()
            ->run();

echo 'ok';