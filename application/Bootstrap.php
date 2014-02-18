<?php
require_once '../library/Smarty/View.php';


class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    /**
     * Bootstrap Smarty view
     */
    protected function _initView()
    {
        // initialize smarty view
        $view = new Smarty_view($this->getOption('smarty'));
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


}

