<?php


class IndexController extends Task_Controller_Action
{
    const COUNT_PER_PAGE = 3;


    public function preDispatch()
    {
        parent::preDispatch();

        $this->id = $this->_request->get('id');

        if ($this->id) {
            $book = Task_Service::getRepository('books')->findById($this->id);

            if (!$book[0] instanceof \Entities\Books) {
                $this->addFlashMessage('Книга не была найдена');
                $this->goToHome();
            }
            $this->book = $book[0];
        }
    }


    public function indexAction()
    {

        $page = $this->getRequest()->getParam('page', 1);

        $dql = 'SELECT b FROM Entities\Books b ORDER BY b.id DESC ';

        $query = $this->getEntityManager()->createQuery($dql);
        $d2Paginator = new Doctrine\ORM\Tools\Pagination\Paginator($query);

        $d2PaginatorIter = $d2Paginator->getIterator();


        $adapter = new \Zend_Paginator_Adapter_Iterator($d2PaginatorIter);

        $zendPaginator = new \Zend_Paginator($adapter);

        $zendPaginator->setItemCountPerPage(self::COUNT_PER_PAGE)
            ->setCurrentPageNumber($page);

        $this->view->paginator = $zendPaginator;
    }


    public function addAction()
    {
        $this->_bookEdit(Task_Service::getModel('books'));
    }

    public function editAction()
    {
        $this->_bookEdit($this->book, 'edit');
    }


    public function downloadAction()
    {
        $fileName = $this->book->getPath();
        $fileFullName = BASE_PATH . Task_Main::getOption('upload/path') . $this->book->getPath();

        if(file_exists($fileFullName)){
            header('Content-Type: text');
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            readfile($fileFullName);
        }else{
            $this->addFlashMessage('Книга не была найдена');
            $this->goBack();
        }

        exit;
    }

    public function deleteAction()
    {
        Task_Service::getEntityManager()->remove($this->book);
        Task_Service::getEntityManager()->flush();

        $this->addFlashMessage('Книга удалена');
        $this->goBack();
    }

    public function optionsAction()
    {

    }


    protected function _bookEdit($book, $type = 'new')
    {
        $form = $this->_getAddForm($book, $type);

        if ($type == 'edit') {
            $form->populateEntity($book);
        }

        if ($this->_request->isPost()) {

            $formData = $this->_request->getPost();

            if ($form->isValid($formData)) {

                $book->setName($form->getValue('name'));
                $book->setUserId(1);


                //Genres
                $genres = $form->getValue('genres');

                //Removing Old Genres
                $currentGenres = $book->getGenre();

                if ($currentGenres->count() > 0) {
                    foreach ($currentGenres as $currentGenre) {
                        if (in_array($currentGenre->getId(), $genres)) {
                            unset($genres[array_search($currentGenre->getId(), $genres)]);
                        } else {
                            $book->removeGenre($currentGenre);
                        }
                    }
                }

                //Write New Genres
                foreach ($genres as $genre) {
                    $genreObj = Task_Service::getRepository('genres')->findById($genre);

                    if ($genreObj[0] instanceof \Entities\Genres) {
                        $book->addGenre($genreObj[0]);
                    }
                }


                //Authors
                $authors = $form->getValue('authors');

                //Removing Old Authors
                $currentAuthors = $book->getAuthor();

                if ($currentAuthors->count() > 0) {
                    foreach ($currentAuthors as $currentAuthor) {
                        if (in_array($currentAuthor->getId(), $genres)) {
                            unset($authors[array_search($currentAuthor->getId(), $authors)]);
                        } else {
                            $book->removeAuthor($currentAuthor);
                        }
                    }
                }

                //Write New Authors
                foreach ($authors as $author) {
                    $authObj = Task_Service::getRepository('authors')->findById($author);

                    if ($authObj[0] instanceof \Entities\Authors) {
                        $book->addAuthor($authObj[0]);
                    }
                }

                if ($form->getElement('file')->getValue() != null) {
                    $form->file->receive();
                    //$originalFilename = pathinfo($form->file->getFileName());

                    $book->setPath($form->getElement('file')->getValue());
                }


                if ($type == 'new') {
                    $this->addFlashMessage('Книга была добавлена');
                    Task_Service::getEntityManager()->persist($book);
                } else {
                    $this->addFlashMessage('Книга была отредактирована');
                }
                Task_Service::getEntityManager()->flush();

                $this->goToHome();

            } else {
                $form->populate($formData);
            }
        }

        $this->view->form = $form;
    }


    protected function _getAddForm(\Entities\Books $books, $type = 'new')
    {
        require_once APPLICATION_PATH . '/forms/Book.php';
        return new Form_Book(null, $books, $type);
    }


}

