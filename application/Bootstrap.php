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


    public function _initServiceManager()
    {
        require_once APPLICATION_PATH . '/configs/ServiceManagerInit.php';
        $serviceManager = new ServiceManagerInit($this);

        return $serviceManager;
    }

    protected function _initConfig()
    {
        $config = new Zend_Config($this->getOptions(), true);
        Zend_Registry::set('config', $config);
        return $config;
    }
}

