<?php

use Task\Controller\Action;


class IndexController extends Action
{
    public function indexAction()
    {
        echo 'Hello world';
        $page = $this->getParam('page', 1);

        $pagerfanta = $this->getModel('book')->getBooksList($page);
        $this->view->pagerfanta = $pagerfanta;

        $this->getJsInit()->addMethod('Task.Paginator.initAjax', '.container > .marketing');
    }


    public function addAction()
    {
        /** @var \Models\Book $model */
        $model = $this->getModel('book');
        $book    = $model->createNewEntity();

        // Get form with
        $form = $model->getForm($book, $model::ADD);

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                // Set values
                $model->editBook($book, $form, $model::ADD);

                $this->addFlashMessage('Книга была добавлена');
                $this->goToHome();

            }
        }

        $this->view->form = $form;
    }


    public function editAction()
    {
        /** @var \Models\Book $model */
        $model = $this->getModel('book');
        $book  = $model->getBookByIdAndUser($this->getRequest());

        if(!$book instanceof \Entities\Books){
            $this->denyPage();
        }

        // Get form with
        $form = $model->getForm($book, $model::EDIT);

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                // Set values
                $model->editBook($book, $form, $model::EDIT);

                $this->addFlashMessage('Книга была отредактирована');
                $this->goToHome();
            }
        }

        $this->view->form = $form;
    }


    public function downloadAction()
    {
        $id = $this->getParam('id');

        /** @var \Models\Book $model */
        $model = $this->getModel('book');
        $book    = $model->getBookById($id);

        $path = $model->getBookPath($book->getUser());
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
        /** @var \Models\Book $model */
        $model = $this->getModel('book');
        $book    = $model->getBookByIdAndUser($this->getRequest());

        if(!$book instanceof \Entities\Books){
            $this->denyPage();
        }

        $model->doRemove($book);

        $this->addFlashMessage('Книга удалена');
        $this->goBack();
    }
}

