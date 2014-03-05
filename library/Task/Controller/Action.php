<?php

namespace Task\Controller;

use Zend_Controller_Action as ZFAction;
use \Zend_Exception;

class Action extends ZFAction
{

    /**
     * init Event
     */
    public function init()
    {
       // $this->Auth = Zend_Auth::getInstance();
    }


    /**
     * postDispatch Event
     */
    public function postDispatch()
    {
        if ($this->_helper->FlashMessenger->hasMessages()) {
            $this->view->flashMessenger = $this->_helper->FlashMessenger->getMessages();
        }

        $this->view->request = $this->getRequest();
    }



    /**
     * @return \Pimple
     */
    public function getServiceManager()
    {
        return \Zend_Registry::get('servicemanager');
    }

    /**
     * @param $service
     * @return mixed
     * @throws \Zend_Exception
     */
    public function getService($service)
    {
        if (!$this->getServiceManager()->offsetExists($service)) {
            throw new Zend_Exception("Сервис $service отсутствует");
        }

        return $this->getServiceManager()->offsetGet($service);
    }


    /**
     * @return \Doctrine\Orm\EntityManager
     */
    public function getEntityManager()
    {
        return $this->getService('em');
    }


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
        $this->_redirect('/');
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
     * Check if coincidence url
     * @param array $options
     * @return bool
     */
    public function checkUrl($options = array())
    {
        //return Task_Main::checkUrl($options);
    }

    protected function gotoRoute($options = array(), $route)
    {
        if($this->_redirector == null){
            $this->_redirector = $this->_helper->getHelper('Redirector');
        }
        return $this->_redirector->gotoRoute($options, $route);
    }


}

