<?php

use Task\Controller\Action;


class AuthorsController extends Action
{
    public function indexAction()
    {
        $page = $this->getParam('page', 1);

        $pagerfanta = $this->getService('author')->getAuthorsList($page);
        $this->view->pagerfanta = $pagerfanta;

        \Task\JsInit::getInstance()->addMethod('Task.Paginator.initAjax', '.row.marketing');
    }


    public function addAction()
    {
        $service = $this->getService('author');
        $author  = $service->createNewEntity();

        // Get form with
        $form = $service->getForm($author, $service::ADD);

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                // Set values
                $service->editAuthor($author, $form, $service::ADD);

                $this->addFlashMessage('Автор был добавлен');
                $this->gotoRoute(array(), 'authors');
            }
        }

        $this->view->form = $form;
    }


    public function editAction()
    {
        $id = $this->getParam('id');
        $service = $this->getService('author');
        $author  = $service->getAuthorById($id);

        // Get form with
        $form = $service->getForm($author, $service::EDIT);

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                // Set values
                $service->editAuthor($author, $form, $service::EDIT);

                $this->addFlashMessage('Автор был отредактирован');
                $this->gotoRoute(array(), 'authors');
            }
        }

        $this->view->form = $form;
    }


    public function deleteAction()
    {
        $id = $this->getParam('id');
        $service = $this->getService('author');
        $author  = $service->getAuthorById($id);

        $service->doRemove($author);

        $this->addFlashMessage('Автор удален');
        $this->goBack();
    }
}