<?php

class ServiceManagerInit
{

    public function __construct()
    {
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

        $pimple['book'] = function ($c){
            return new \Models\Book($c);
        };

        $pimple['genre'] = function ($c){
            return new \Models\Genre($c);
        };

        $pimple['author'] = function ($c){
            return new \Models\Author($c);
        };

        $pimple['user'] = function ($c){
            return new \Models\User($c);
        };

        /**
         * @param $c
         * @return \Task\Service\Paginator
         */
        $pimple['paginator'] = function ($c){
            return new \Task\Service\Paginator($c);
        };

        $sm = \Task\ServiceManager::getInstance();
        $sm::setServiceManager($pimple);
    }
}
