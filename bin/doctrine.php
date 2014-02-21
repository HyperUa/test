<?php
$myproj = dirname(__FILE__) . '/../../';
$vendor = $myproj . 'vendor/';
$webapp = $myproj . 'webapp/';


require_once($vendor . 'autoload.php');


define('APPLICATION_ENV', 'development');

define('APPLICATION_PATH', ($webapp . 'application'));

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));


$classLoader = new \Doctrine\Common\ClassLoader(
    'Repository',
    APPLICATION_PATH
);
$classLoader->register();
$classLoader = new \Doctrine\Common\ClassLoader(
    'Entities',
    APPLICATION_PATH
);
$classLoader->register();


// Create application
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

// bootstrap doctrine
$application->getBootstrap()->bootstrap('doctrine');
$em = $application->getBootstrap()->getResource('doctrine');

// generate the Doctrine HelperSet
$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));

\Doctrine\ORM\Tools\Console\ConsoleRunner::run($helperSet);