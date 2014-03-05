<?php
namespace Task\Service;

Class Doctrine
{
    private $container;

    public function __construct(\Pimple $container)
    {
        $this->container = $container;
    }

    public function getEntityManager()
    {
        $bootstrap = $this->container->offsetGet('bootstrap');
        $connectionSettings = $bootstrap->getOption('doctrine');

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

        $classLoader = new \Doctrine\Common\ClassLoader(
            'Models',
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

        return \Doctrine\ORM\EntityManager::create($connectionSettings['conn'], $config);
    }
}