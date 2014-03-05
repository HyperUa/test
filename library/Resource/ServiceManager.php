<?php

namespace Resource;


class ServiceManager
{

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $pimple = new Pimple;

        // Register Front Controller
        $pimple['front_controller'] = Zend_Controller_Front::getInstance();

        // Register Model
        $pimple['model'] = function ($c) {
            return new Task\Service\Model($c);
        };

        // Register Entity Manager
        $pimple['em'] = function ($c){
            $doctrine = new Task\Service\Doctrine($c);
            return $doctrine::getEntityManager();
        };

        $pimple['book'] = function ($c){
            return new \Models\Book;
        };

        // Register Entity Request
        $pimple['request'] = function ($c){
            return $c->offsetGet('front_controller')->getRequest();
        };

        // Register Entity Response
        $pimple['response'] = function ($c){
            return $c->offsetGet('front_controller')->getResponse();
        };

        // Register Bootstrap
        $pimple['bootstrap'] = function ($c){
            return $c->offsetGet('front_controller')->getParam('bootstrap');
        };

        Zend_Registry::set('servicemanager', $pimple);
    }
}
