<?php

use Task\Controller\Action;


class AuthorsController extends Action
{
    public function indexAction()
    {
        $page = $this->getParam('page', 1);

        $pagerfanta = $this->getModel('author')->getAuthorsList($page);
        $this->view->pagerfanta = $pagerfanta;

        $this->getJsInit()->addMethod('Task.Paginator.initAjax', '.container > .marketing');
    }


    public function addAction()
    {
        /** @var \Models\Author $model */
        $model = $this->getModel('author');
        $author  = $model->createNewEntity();

        // Get form with
        $form = $model->getForm($author, $model::ADD);

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                // Set values
                $model->editAuthor($author, $form, $model::ADD);

                $this->addFlashMessage('Автор был добавлен');
                $this->gotoRoute(array(), 'authors');
            }
        }

        $this->view->form = $form;
    }


    public function editAction()
    {
        $id = $this->getParam('id');

        /** @var \Models\Author $model */
        $model = $this->getModel('author');
        $author  = $model->getAuthorById($id);

        // Get form with
        $form = $model->getForm($author, $model::EDIT);

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                // Set values
                $model->editAuthor($author, $form, $model::EDIT);

                $this->addFlashMessage('Автор был отредактирован');
                $this->gotoRoute(array(), 'authors');
            }
        }

        $this->view->form = $form;
    }


    public function deleteAction()
    {
        $id = $this->getParam('id');

        /** @var \Models\Author $model */
        $model = $this->getModel('author');
        $author  = $model->getAuthorById($id);

        $model->doRemove($author);

        $this->addFlashMessage('Автор удален');
        $this->goBack();
    }
}