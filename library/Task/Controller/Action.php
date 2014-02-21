<?php


class Task_Controller_Action extends Zend_Controller_Action{


    public function init()
    {
        /* Initialize action controller here */
        $registry = Zend_Registry::getInstance();
        $this->_em = $registry->entitymanager;


        $this->Auth = Zend_Auth::getInstance();
    }

    /**
     * @return Doctrine\ORM\EntityManager
     */
    public function getEntityManager(){
        return $this->_em;
    }

}

