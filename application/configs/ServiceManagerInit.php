<?php

class ServiceManagerInit
{
    private $bootstrap;

    public function __construct(\Zend_Application_Bootstrap_Bootstrap $bootstrap)
    {
        $this->bootstrap = $bootstrap;
        $this->init();
    }

    public function init()
    {
        $pimple = new Pimple;

        // Register Entity Manager
        $pimple['em'] = function ($c){
            $doctrine = new Task\Service\Doctrine($c);
            return $doctrine->getEntityManager();
        };

        $config = $this->bootstrap->getOptions();
        $pimple['config'] = function () use ($config){
            return new \Task\Service\ConfigManager($config);
        };

        $pimple['modelManager'] = function (){
            return new \Task\Service\ModelManager();
        };

        $pimple['paginator'] = function (){
            return new \Task\Service\Paginator();
        };

        $sm = \Task\ServiceManager::getInstance();
        $sm::setServiceManager($pimple);
    }
}
