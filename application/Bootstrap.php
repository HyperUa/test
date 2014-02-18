<?php

require_once '../library/Smarty/View.php';


class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

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


    /**
     * Init Registry
     * @return Zend_Registry
     */
    protected function _initRegistry()
    {
        $registry = Zend_Registry::getInstance();
        return $registry;
    }


    /**
     * Регистрация пространства имен Default_
     * @return Zend_Application_Module_Autoloader
     */
    protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath' => dirname(__FILE__),
        ));
        return $autoloader;
    }

    /**
     * Init Doctrine
     * @return Doctrine_Manager
     */
    public function _initDoctrine()
    {
        // Подключение класс-лоадера
        //require_once('Doctrine/Common/ClassLoader.php');
        $classLoader = new \Doctrine\Common\ClassLoader(
            'Doctrine',
            APPLICATION_PATH . '/../library/'
        );
        $classLoader->register();

        // Создание конфигурации Doctrine
        $config = new \Doctrine\ORM\Configuration();

        // Настройка кеша (используется ArrayCache)
        $cache = new \Doctrine\Common\Cache\ArrayCache;
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);

        // Устанавлмваем драйвер для схемы БД
        // Будем использовать аннотации
        $driver = $config->newDefaultAnnotationDriver(
            APPLICATION_PATH . '/models'
        );
        $config->setMetadataDriverImpl($driver);

        // Прокси
        $config->setProxyDir(APPLICATION_PATH . '/models/Proxies');
        $config->setAutoGenerateProxyClasses(true);
        $config->setProxyNamespace('App\Proxies');

        // Создаем EntityManager
        // с параметрами из application.ini
        $connectionSettings = $this->getOption('doctrine');
        $conn = array(
            'driver' => $connectionSettings['conn']['driv'],
            'user' => $connectionSettings['conn']['user'],
            'password' => $connectionSettings['conn']['pass'],
            'dbname' => $connectionSettings['conn']['dbname'],
            'host' => $connectionSettings['conn']['host']
        );
        $entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);

        // Сохраним менеджер в реестре
        $registry = Zend_Registry::getInstance();
        $registry->entitymanager = $entityManager;

        return $entityManager;
    }


}

