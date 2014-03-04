<?php

use Task\Controller\Action;


class IndexController extends Action
{
    const COUNT_PER_PAGE = 3;


    public function preDispatch()
    {
        parent::preDispatch();

        $this->id = $this->getRequest()->get('id');

        if ($this->id) {

           $book = Task_Service::getRepository('books')->findOneBy(array('id' => $this->id));

            if (!$book instanceof \Entities\Books) {
                $this->addFlashMessage('Книга не была найдена');
                //$this->goToHome();
            }
            $this->book = $book;
        }
    }





    public function indexAction()
    {
        $pageSize = 2;
        $currentPage = 1;

        $dql = 'SELECT b FROM \Entities\Books b ORDER BY b.id DESC';
        $query = $this->getEntityManager()
            ->createQuery($dql);



        $paginator  = new Task\Tools\Doctrine\Paginator($query);
        $paginator->setItemCountPerPage(2)
            ->setCurrentPageNumber(1);

        $pager = $paginator->getIterator();



        d($paginator->getMaxPage());






        $totalItems = count($paginator);
        d($totalItems);
        $pagesCount = ceil($totalItems / $pageSize);

// now get one page's items:
        $paginator
            ->getQuery()
            ->setFirstResult($pageSize * ($currentPage-1)) // set the offset
            ->setMaxResults($pageSize); // set the limit


        foreach ($paginator as $pageItem) {
            echo "<li>" . $pageItem->getName() . "</li>";
        }

d('dfg');

        $page = $this->getRequest()->getParam('page', 1);

        $dql = 'SELECT SQL_CALC_FOUND_ROWS b FROM \Entities\Books b ORDER BY b.id DESC';
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setMaxResults(2);




        d($query->getResult());


        $paginator = new Doctrine\ORM\Tools\Pagination\Paginator($query, $fetchJoinCollection = true);

        $paginatorIter = $paginator->getIterator();

d(count($paginatorIter));


        foreach($paginatorIter as $el){
            echo $el->getHeadline() . "\n";
        }

d($paginatorIter);

        $adapter = new \Zend_Paginator_Adapter_Iterator($paginatorIter);

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
                foreach ($genres as $genreId) {

                    $genreObj = Task_Service::getRepository('genres')->findOneBy(array('id' => $genreId));

                    if ($genreObj instanceof \Entities\Genres) {
                        $book->addGenre($genreObj);
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
                foreach ($authors as $authorId) {
                    $authObj = Task_Service::getRepository('authors')->findOneBy(array('id' => $authorId));

                    if ($authObj instanceof \Entities\Authors) {
                        $book->addAuthor($authObj);
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

