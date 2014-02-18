<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $registry = Zend_Registry::getInstance();
        $this->_em = $registry->entitymanager;
    }

    public function indexAction()
    {
        // action body
        //d('Hello = indexAction');

        $book = $this->_em->getRepository('Model_Book')->findOneBy(array(
            'id' => 2
        ));

        // d($book->getId());


        $testEntity = new Model_Book;
        $testEntity->setName('Some name');
        $this->_em->persist($testEntity);
        $this->_em->flush();


        $this->view->hello = 'Hello Smarty';
    }

    public function addAction()
    {
        d('Hello = addAction');
    }


}

