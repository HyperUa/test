<?php

use Task\Controller\Action;


class IndexController extends Action
{
    public function indexAction()
    {
        $page = $this->getParam('page', 1);

        $pagerfanta = $this->getService('book')->getBooksList($page);
        $this->view->pagerfanta = $pagerfanta;

        \Task\JsInit::getInstance()->addMethod('Task.Paginator.initAjax', '.row.marketing');
    }


    public function addAction()
    {
        $service = $this->getService('book');
        $book    = $service->createNewEntity();

        // Get form with
        $form = $service->getForm($book, $service::ADD);

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                // Set values
                $service->editBook($book, $form, $service::ADD);

                $this->addFlashMessage('Книга была добавлена');
                $this->goToHome();

            }
        }

        $this->view->form = $form;
    }


    public function editAction()
    {
        $service = $this->getService('book');
        $book    = $service->getBookByIdAndUser($this->getRequest());

        if(!$book instanceof \Entities\Books){
            $this->denyPage();
        }

        // Get form with
        $form = $service->getForm($book, $service::EDIT);

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                // Set values
                $service->editBook($book, $form, $service::EDIT);

                $this->addFlashMessage('Книга была отредактирована');
                $this->goToHome();
            }
        }

        $this->view->form = $form;
    }


    public function downloadAction()
    {
        $id = $this->getParam('id');
        $service = $this->getService('book');
        $book    = $service->getBookById($id);

        $path = $service->getBookPath($book->getUser());
        $fileFullName = $path . $book->getPath();

        if(file_exists($fileFullName)){
            header('Content-Type: text');
            header('Content-Disposition: attachment; filename="' . $book->getBaseName() . '"');
            readfile($fileFullName);
        }else{
            $this->addFlashMessage('Книга не была найдена');
            $this->goBack();
        }

        exit;
    }

    public function deleteAction()
    {
        $service = $this->getService('book');
        $book    = $service->getBookByIdAndUser($this->getRequest());

        if(!$book instanceof \Entities\Books){
            $this->denyPage();
        }

        $service->doRemove($book);

        $this->addFlashMessage('Книга удалена');
        $this->goBack();
    }

    public function optionsAction()
    {

    }
}

