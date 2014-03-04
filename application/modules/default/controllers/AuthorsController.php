<?php

class AuthorsController extends Task_Controller_Action
{

    public function preDispatch()
    {
        parent::preDispatch();

        $this->id = $this->_request->get('id');

        if ($this->id) {
            $author = Task_Service::getRepository('authors')->findById($this->id);

            if (!$author[0] instanceof \Entities\Authors) {
                $this->addFlashMessage('Автор не был найден');
               // $this->goToHome();
            }
            $this->author = $author[0];
        }
    }


    public function indexAction()
    {
        $this->view->authors = Task_Service::getRepository('authors')->findAll();
    }

    public function addAction()
    {
        $this->_AuthorEdit(Task_Service::getModel('authors'));
    }

    public function editAction()
    {
        $this->_AuthorEdit($this->author, 'edit');
    }

    public function deleteAction()
    {
        Task_Service::getEntityManager()->remove($this->author);
        Task_Service::getEntityManager()->flush();

        $this->addFlashMessage('Автор удален');
        $this->goBack();
    }


    protected function _AuthorEdit($author, $type = 'new')
    {

        $form = $this->_getAuthorForm($type);

        if ($type == 'edit') {
            $form->populateEntity($author);
        }

        if ($this->_request->isPost()) {

            $formData = $this->_request->getPost();

            if ($form->isValid($formData)) {

                $author->setName($form->getValue('name'));

                if ($type == 'new') {
                    $this->addFlashMessage('Автор был добавлен');
                    Task_Service::getEntityManager()->persist($author);
                } else {
                    $this->addFlashMessage('Автор был отредактирован');
                }
                Task_Service::getEntityManager()->flush();

                $this->redirect($this->gotoRoute(array(), 'authors'));

            } else {
                $form->populate($formData);
            }
        }

        $this->view->form = $form;
    }


    protected function _getAuthorForm($type = 'new')
    {
        require_once APPLICATION_PATH . '/forms/Author.php';
        return new Form_Author(null, $type);
    }


}