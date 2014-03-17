<?php

namespace Models;

use Entities;
use Forms\Book as Book_Form;
use Models\Exeption\Book as Book_Exeption;

/**
 * Class Book
 * @package Models
 */
class Book extends Processor
{

    /**
     * @return Entities\Books
     */
    public function createNewEntity()
    {
        return new Entities\Books();
    }


    /**
     * @param Entities\Books $book
     * @param $type
     * @param null $options
     * @return Book_Form
     */
    public function getForm(Entities\Books $book, $type, $options = null)
    {
        $form = new Book_Form($options, $book, $type);

        if ($type == self::EDIT) {
            $form->populateEntity($book);

            if ($book->getPath() != null) {
                \Task\JsInit::getInstance()->addMethod('Task.Form.setFilePath', $book->getBaseName(), 'file');
            }
        }
        $form->getElement('submit')->setLabel($type);

        return $form;
    }


    /**
     * @param Entities\Books $book
     * @param \Zend_Form $form
     * @param $type [self::EDIT, self::ADD]
     * @return bool
     */
    public function editBook($book, \Zend_Form $form, $type)
    {
        //throw new \Exception('sdf');
        //$book = '';
        if(!$book instanceof \Entities\Books){
            throw new Book_Exeption('Значение должно пренадлежать \Entities\Books');
        }

        $user = $this->getModel('user')->getIdentityUser();

        if( $form->getValue('name') == ''){
            throw new Book_Exeption('Название книги не должно быть пустым');
        }

        $book->setName($form->getValue('name'));
        $book->setUser($user);


        //Genres
        $genres = $form->getValue('genres');

        /** @var  \Models\Genre */
        $genreModel = $this->getModel('genre');
        $genreModel->editGenresByBook($book, $genres);


        //Authors
        $authors = $form->getValue('authors');

        /** @var  Author */
        $genreModel = $this->getModel('author');
        $genreModel->editAuthorsByBook($book, $authors);


        // File
        if ($form->getElement('file')->getValue() != null) {

            $fileInfo = $form->file->getFileInfo();
            $ext = pathinfo($fileInfo['file']['name'], PATHINFO_EXTENSION);

            $dir = $this->getBookPath($user);
            if (!file_exists($dir)) {
                mkdir($dir);
            }

            $name = microtime(true) . '.' . $ext;
            rename($fileInfo['file']['tmp_name'], $dir . $name);

            // Remove Old
            if ($book->getPath() != null) {
                unlink($dir . $book->getPath());
            }

            $book->setPath($name);
            $book->setBaseName($form->getElement('file')->getValue());
        }

        $em = $this->getEntityManager();
        if ($type == self::ADD) {
            $em->persist($book);
        }
        $em->flush();

        return true;
    }


    /**
     * @param $id
     * @return Entities\Books
     * @throws \Zend_Controller_Exception
     */
    public function getBookById($id)
    {
        $book = $this->getEntityManager()->getRepository('Entities\Books')->find($id);

        if (!$book instanceof Entities\Books) {
            throw new \Zend_Controller_Exception('Книга не найдена', 404);
        }

        return $book;
    }


    /**
     * Find book by current User id and Book id
     *
     * @param \Zend_Controller_Request_Abstract $request
     * @return \Entities\Books
     */
    public function getBookByIdAndUser(\Zend_Controller_Request_Abstract $request)
    {
        if (($book_id = $request->getParam('id')) == null || !\Zend_Auth::getInstance()->hasIdentity()) {
            return false;
        }

        return $this->getEntityManager()->getRepository('Entities\Books')->getBookByIdAndUser(
            $book_id,
            \Zend_Auth::getInstance()->getIdentity()
        );
    }

    /**
     * Remove Book
     * @param Entities\Books $book
     */
    public function doRemove(\Entities\Books $book)
    {
        $em = $this->getEntityManager();
        $em->remove($book);
        $em->flush();
    }

    /**
     *  Get Book Path by User
     * @param Entities\Users|int $user
     * @param bool $isFull
     * @return string
     */
    public function getBookPath($user, $isFull = true)
    {
        $path = $this->getService('config')->getConfig('uploadpath')->books;

        if($user instanceof \Entities\Users){
            $path .= 'User_'.$user->getId().'/';
        }else{
            $path .= 'User_'.$user.'/';
        }

        if($isFull){
            return BASE_PATH . $path;
        }
        return $path;
    }

    /**
     * @param int $page
     * @param array $filter
     * @return \Pagerfanta\Pagerfanta
     */
    public function getBooksList($page = 1, $filter = array())
    {
        $paginator = $this->getService('paginator');

        $dql = 'SELECT b FROM \Entities\Books b ORDER BY b.id DESC';
        $query = $this->getEntityManager()
            ->createQuery($dql);

        // Create Paginator
        $pagerfanta = $paginator
            ->getORMpagerFanta($query, $page, self::COUNT_PER_PAGE);

        return $pagerfanta;
    }
}