<?php

class GenresController extends Task_Controller_Action
{

    public function preDispatch()
    {
        parent::preDispatch();

        $this->id = $this->_request->get('id');

        if ($this->id) {
            $genres = Task_Service::getRepository('genres')->findById($this->id);

            if (!$genres[0] instanceof \Entities\Genres) {
                $this->addFlashMessage('Жанр не был найден');
               // $this->goToHome();
            }
            $this->genre = $genres[0];
        }
    }


    public function indexAction()
    {
        $this->view->genres = Task_Service::getRepository('genres')->findAll();
    }

    public function addAction()
    {
        $this->_GenreEdit(Task_Service::getModel('genres'));
    }

    public function editAction()
    {
        $this->_GenreEdit($this->genre, 'edit');
    }

    public function deleteAction()
    {
        Task_Service::getEntityManager()->remove($this->genre);
        Task_Service::getEntityManager()->flush();

        $this->addFlashMessage('Жанр удален');
        $this->goBack();
    }


    protected function _GenreEdit($genre, $type = 'new')
    {

        $form = $this->_getGenreForm($type);

        if ($type == 'edit') {
            $form->populateEntity($genre);
        }

        if ($this->_request->isPost()) {

            $formData = $this->_request->getPost();

            if ($form->isValid($formData)) {

                $genre->setGenre($form->getValue('genre'));

                if ($type == 'new') {
                    $this->addFlashMessage('Жанр был добавлен');
                    Task_Service::getEntityManager()->persist($genre);
                } else {
                    $this->addFlashMessage('Жанр был изменен');
                }
                Task_Service::getEntityManager()->flush();

                $this->redirect($this->gotoRoute(array(), 'genres'));

            } else {
                $form->populate($formData);
            }
        }

        $this->view->form = $form;
    }


    protected function _getGenreForm($type = 'new')
    {
        require_once APPLICATION_PATH . '/Forms/Genre.php';
        return new Form_Genre(null, $type);
    }


}