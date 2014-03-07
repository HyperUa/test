<?php

use Task\Controller\Action;


class GenresController extends Action
{
    const COUNT_PER_PAGE = 5;


    public function indexAction()
    {
        $page = $this->getParam('page', 1);
        $paginator = $this->getService('paginator');

        $dql = 'SELECT g FROM \Entities\Genres g ORDER BY g.id DESC';
        $query = $this->getEntityManager()
            ->createQuery($dql);

        // Create Paginator
        $pagerfanta = $paginator
            ->getORMpagerFanta($query, $page, self::COUNT_PER_PAGE);

        $this->view->pagerfanta = $pagerfanta;
    }


    public function addAction()
    {
        $service = $this->getService('genre');
        $genre    = $service->createNewEntity();

        // Get form with
        $form = $service->getForm($genre, $service::ADD);

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                // Set values
                $service->editGenre($genre, $form, $service::ADD);

                $this->addFlashMessage('Жанр был добавлен');
                $this->gotoRoute(array(), 'genres');
            }
        }

        $this->view->form = $form;
    }


    public function editAction()
    {
        $id = $this->getParam('id');
        $service = $this->getService('genre');
        $genre    = $service->getGenreById($id);

        // Get form with
        $form = $service->getForm($genre, $service::EDIT);

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                // Set values
                $service->editGenre($genre, $form, $service::EDIT);

                $this->addFlashMessage('Жанр был отредактирован');
                $this->gotoRoute(array(), 'genres');
            }
        }

        $this->view->form = $form;
    }


    public function deleteAction()
    {
        $id = $this->getParam('id');
        $service = $this->getService('genre');
        $genre    = $service->getGenreById($id);

        $service->doRemove($genre);

        $this->addFlashMessage('Жанр удален');
        $this->goBack();
    }
}