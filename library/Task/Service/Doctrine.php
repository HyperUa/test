<?php

namespace Task\Service;

use Zend_Config_Ini;


Class Doctrine
{
    public function getEntityManager()
    {
        $db_config = \Task\ServiceManager::getInstance()->getConfigManager()->getConfig('db', 'doctrine');
        $connect = $db_config->conn->toArray();

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
            $db_config->path->models,
            $db_config->path->simpleDriver
        );

        $config->setMetadataDriverImpl($driver);

        $config->setProxyDir(APPLICATION_PATH . '/Entities/Proxies');
        $config->setAutoGenerateProxyClasses(true);
        $config->setProxyNamespace('Proxies');

        return \Doctrine\ORM\EntityManager::create($connect, $config);
    }
}