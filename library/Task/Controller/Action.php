<?php

namespace Task\Controller;

use Zend_Controller_Action as ZFAction;
use Zend_Exception;
use Task\ServiceManager;


class Action extends ZFAction
{

    public function preDispatch()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->_helper->_layout->setLayout('ajax');
        }
    }

    
    public function postDispatch()
    {
        if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->flashMessenger = $this->_helper->FlashMessenger->getMessages();
        }

        \Task\JsInit::getInstance()->addMethod('Task.Events.init');
    }


    public function denyPage()
    {
        $this->addFlashMessage('У вас нет прав для просмотра данной страницы');
        $this->goToHome();
    }

    /**
     * @return \Pimple
     */
    public function getServiceManager()
    {
        return $this->getManager()->getServiceManager();
    }

    /**
     * @param $service
     * @return mixed
     * @throws \Zend_Exception
     */
    public function getService($service)
    {
        return $this->getManager()->getService($service);
    }

    /**
     * @return \Doctrine\Orm\EntityManager
     */
    public function getEntityManager()
    {
        return $this->getService('em');
    }

    /**
     * @return ServiceManager
     */
    private function getManager()
    {
        return ServiceManager::getInstance();
    }

    /**
     * @return \Zend_Controller_Router_Interface
     */
    public function getRouter()
    {
        return $this->getFrontController()->getRouter();
    }

    /**
     * Redirect to home page
     * @return void
     */
    protected function goToHome()
    {
        $this->gotoRoute(array(), 'home');
    }

    /**
     * Redirect to prev page
     * @return void
     */
    protected function goBack()
    {
        $this->_redirect($this->getRequest()->getServer('HTTP_REFERER'));
    }

    /**
     * Add Flash Message
     * @param $message
     */
    protected function addFlashMessage($message)
    {
        $flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $flashMessenger->addMessage($message);
    }

    /**
     * @param array $options
     * @param $route
     * @return mixed
     */
    public function gotoRoute($options = array(), $route)
    {
        $redirector =  $this->_helper->getHelper('Redirector');
        return $redirector->gotoRoute($options, $route);
    }
}

