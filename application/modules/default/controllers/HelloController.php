<?php

class HelloController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        d('Hello = indexAction');

    }

    public function addAction()
    {
        d('Hello = addAction');
    }


}

