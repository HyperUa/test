<?php

class Task_Controller_Acount extends Task_Controller_Action{

    public function init(){
        parent::init();
    }


    public function preDispatch()
    {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            return $this->_redirect('/');
        }
    }



}