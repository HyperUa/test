<?php

use Task\Service\Model;
use Task\Service\Repository;
use Task\Service\Entity;



class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected $servicemanager;


    /**
     * Init Bootstrap
     * @return Smarty
     */
    protected function _initView()
    {
        // initialize smarty view
        $view = new Smarty_View($this->getOption('smarty'));
        // setup viewRenderer with suffix and view
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->setViewSuffix('tpl');
        $viewRenderer->setView($view);

        // ensure we have layout bootstraped
        $this->bootstrap('layout');
        // set the tpl suffix to layout also
        $layout = Zend_Layout::getMvcInstance();
        $layout->setViewSuffix('tpl');

        return $view;
    }


/*
    public function _initDoctrine()
    {
        $connectionSettings = $this->getOption('doctrine');

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


        $config = new \Doctrine\ORM\Configuration();

        $cache = new \Doctrine\Common\Cache\ArrayCache;
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);


        $driver = $config->newDefaultAnnotationDriver(
            $connectionSettings['path']['models'],
            $connectionSettings['path']['simpleDriver']
        );

        $config->setMetadataDriverImpl($driver);


        $config->setProxyDir(APPLICATION_PATH . '/Entities/Proxies');
        $config->setAutoGenerateProxyClasses(true);
        $config->setProxyNamespace('Proxies');

        $conn = array(
            'driver' => $connectionSettings['conn']['driv'],
            'user' => $connectionSettings['conn']['user'],
            'password' => $connectionSettings['conn']['pass'],
            'dbname' => $connectionSettings['conn']['dbname'],
            'host' => $connectionSettings['conn']['host'],
            'driverOptions' => $connectionSettings['conn']['driver']

        );
        $entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);

        Zend_Registry::getInstance()->pimple['entitymanager'] = $entityManager;

        return $entityManager;
    }
*/

    public function _initRequest()
    {

        $Request = new Zend_Controller_Request_Http;
        $this->getResource('frontController')
            ->getRouter()
            ->addConfig(new Zend_Config_Ini(APPLICATION_PATH . "/configs/routes.ini"), "routes")
            ->route($Request);

        return $Request;
    }

    public function _initRegistry()
    {
        return Zend_Registry::getInstance();
    }


    public function _initServiceManager()
    {
        $this->bootstrap('registry');
        require_once APPLICATION_PATH . '/configs/ServiceManagerInit.php';
        $serviceManager = new ServiceManagerInit($this);

        return $serviceManager;
    }
}

