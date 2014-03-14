<?php

use Task\Controller\Action;


class GenresController extends Action
{
    public function indexAction()
    {
        $page = $this->getParam('page', 1);

        $pagerfanta = $this->getModel('genre')->getGenresList($page);
        $this->view->pagerfanta = $pagerfanta;

        \Task\JsInit::getInstance()->addMethod('Task.Paginator.initAjax', '.container > .marketing');
    }


    public function addAction()
    {
        /** @var \Models\Author $model */
        $model = $this->getModel('genre');
        $genre    = $model->createNewEntity();

        // Get form with
        $form = $model->getForm($genre, $model::ADD);

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                // Set values
                $model->editGenre($genre, $form, $model::ADD);

                $this->addFlashMessage('Жанр был добавлен');
                $this->gotoRoute(array(), 'genres');
            }
        }

        $this->view->form = $form;
    }


    public function editAction()
    {
        $id = $this->getParam('id');

        /** @var \Models\Author $model */
        $model = $this->getModel('genre');
        $genre    = $model->getGenreById($id);

        // Get form with
        $form = $model->getForm($genre, $model::EDIT);

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                // Set values
                $model->editGenre($genre, $form, $model::EDIT);

                $this->addFlashMessage('Жанр был отредактирован');
                $this->gotoRoute(array(), 'genres');
            }
        }

        $this->view->form = $form;
    }


    public function deleteAction()
    {
        $id = $this->getParam('id');

        /** @var \Models\Author $model */
        $model = $this->getModel('genre');
        $genre    = $model->getGenreById($id);

        $model->doRemove($genre);

        $this->addFlashMessage('Жанр удален');
        $this->goBack();
    }
}