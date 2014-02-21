<?php


class IndexController extends Task_Controller_Action
{



    public function indexAction()
    {

        $books = $this->getEntityManager()->getRepository('Entities\Books')->findAll();

        $this->view->hello = 'Hello Smarty';
    }

    public function addAction()
    {
        $form = $this->_getAddForm();

        if ($this->_request->isPost()) {

            $formData = $this->_request->getPost();

            if($form->isValid($formData)){

                $book = Task_Service::getModel('books');
                $book->setName($form->getValue('name'));
                $book->setUserId(1);

                foreach($form->getValue('genres') as $genre){

                    $genreObj = Task_Service::getRepository('genres')->findById($genre);

                    if($genreObj[0] instanceof \Entities\Genres){
                        $book->addGenre($genreObj[0]);
                    }
                }

                foreach($form->getValue('authors') as $author){

                    $authorObj = Task_Service::getRepository('authors')->findById($author);

                    if($authorObj[0] instanceof \Entities\Authors){
                        $book->addAuthor($authorObj[0]);
                    }
                }

                Task_Service::getEntityManager()->persist($book);
                Task_Service::getEntityManager()->flush();

                $this->_redirect('/');

            }else{
                $form->populate($formData);
            }
        }

        $this->view->form = $form;
    }

    protected function _getAddForm()
    {
        require_once APPLICATION_PATH . '/forms/AddBook.php';
        return new Form_AddBook();
    }


}

