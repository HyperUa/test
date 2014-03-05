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
    const EDIT = 'Edit';
    const ADD = 'Add';


    public function __construct(\Pimple $container)
    {
        parent::__construct($container);
    }

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
        }

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
        $book->setName($form->getValue('name'));
        $book->setUserId(1);


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
            $genreObj = $this->getEntityManager()->getRepository('Entities\Genres')->findOneBy(array('id' => $genreId));

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
            $authObj = $this->getEntityManager()->getRepository('Entities\Authors')->findOneBy(array('id' => $authorId));

            if ($authObj instanceof \Entities\Authors) {
                $book->addAuthor($authObj);
            }
        }


        // File
        if ($form->getElement('file')->getValue() != null) {
            $form->file->receive();
            //$originalFilename = pathinfo($form->file->getFileName());

            $book->setPath($form->getElement('file')->getValue());
        }

        if ($type == self::ADD) {
            $this->getEntityManager()->persist($book);
        }
        $this->getEntityManager()->flush();

        return true;
    }

    public function getBookById($id)
    {
        $book = $this->getEntityManager()->getRepository('Entities\Books')->findOneBy(array('id' => $id));

        if(!$book instanceof Entities\Books){
            throw new \Zend_Controller_Exception('Книга не найдена', 404);
        }

        return $book;
    }
}