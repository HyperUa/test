<?php
$myproj = dirname(__FILE__) . '/../../';
$vendor = $myproj . 'vendor/';
$webapp = $myproj . 'webapp/';


require_once($vendor . 'autoload.php');
require_once($webapp.'/library/Task/Service/Doctrine.php');

define('APPLICATION_PATH', ($webapp . '/application'));


$doctrine = new Task\Service\Doctrine();
$em = $doctrine->getEntityManager();

// generate the Doctrine HelperSet
$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));

\Doctrine\ORM\Tools\Console\ConsoleRunner::run($helperSet);
