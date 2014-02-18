<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        //d('Hello = indexAction');
        $this->view->hello = 'Hello Smarty';
    }

    public function addAction()
    {
        d('Hello = addAction');
    }


}

