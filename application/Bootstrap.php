<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Init Bootstrap
     * @return Smarty
     */
    protected function _initView()
    {
        // initialize smarty view
        $view = new Task\Service\SmartyView($this->getOption('smarty'));
        // setup viewRenderer with suffix and view
        $viewRenderer = \Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
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
        return new ServiceManagerInit($this);
    }

    protected function _initConfig()
    {
        $config = new Zend_Config($this->getOptions(), true);
        Zend_Registry::set('config', $config);

        return $config;
    }
}

