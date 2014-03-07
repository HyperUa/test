<?php

namespace Models;

use Entities;
use Forms\Book as Book_Form;

/**
 * Class Book
 * @package Models
 */
class Book extends Processor
{
    const EDIT = 'Редактировать';
    const ADD = 'Добавить';


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
    public function editBook(Entities\Books $book, \Zend_Form $form, $type)
    {
        $user = $this->getService('user')->getIdentityUser();
        $book->setName($form->getValue('name'));
        $book->setUser($user);

        //Genres
        $genres = $form->getValue('genres');
        //Removing Old Genres
        $currentGenres = $book->getGenres();

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
            $genreObj = $this->getEntityManager()->getRepository('Entities\Genres')->find($genreId);

            if ($genreObj instanceof \Entities\Genres) {
                $book->addGenre($genreObj);
            }
        }


        //Authors
        $authors = $form->getValue('authors');

        //Removing Old Authors
        $currentAuthors = $book->getAuthors();

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
            $authObj = $this->getEntityManager()->getRepository('Entities\Authors')->find($authorId);

            if ($authObj instanceof \Entities\Authors) {
                $book->addAuthor($authObj);
            }
        }


        // File
        if ($form->getElement('file')->getValue() != null) {

            $fileInfo = $form->file->getFileInfo();
            $ext = pathinfo($fileInfo['file']['name'], PATHINFO_EXTENSION);

            $dir = $this->getBookPath($user);
            if(!file_exists($dir)){
                mkdir($dir);
            }

            $name = microtime(true).'.'.$ext;
            rename($fileInfo['file']['tmp_name'], $dir.$name);

            // Remove Old
            if($book->getPath() != null){
                unlink($dir .$book->getPath());
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

    public function getBookById($id)
    {
        $book = $this->getEntityManager()->getRepository('Entities\Books')->find($id);

        if(!$book instanceof Entities\Books){
            throw new \Zend_Controller_Exception('Книга не найдена', 404);
        }

        return $book;
    }


    public function doRemove(\Entities\Books $book)
    {
        $em = $this->getEntityManager();
        $em->remove($book);
        $em->flush();
    }


    public function getBookPath(\Entities\Users $user)
    {
        return BASE_PATH.'/data/uploads/User_'.$user->getId().'/' ;
    }
}