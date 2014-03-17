<?php

namespace Models;

use Entities;
use Forms\Genre as Genre_Form;
use Models\Exeption\Genre as Genre_Exeption;

/**
 * Class Genre
 * @package Models
 */
class Genre extends Processor
{
    const COUNT_PER_PAGE = 3;

    /**
     * @return Entities\Genres
     */
    public function createNewEntity()
    {
        return new Entities\Genres();
    }

    /**
     * @param Entities\Genres $genre
     * @param $type
     * @param null $options
     * @return Genre_Form
     */
    public function getForm(Entities\Genres $genre, $type, $options = null)
    {
        $form = new Genre_Form($options);

        if ($type == self::EDIT) {
            $form->populateEntity($genre);
        }
        $form->getElement('submit')->setLabel($type);

        return $form;
    }

    /**
     * @param Entities\Genres $genre
     * @param \Zend_Form $form
     * @param $type
     * @return bool
     */
    public function editGenre(Entities\Genres $genre, \Zend_Form $form, $type)
    {
        $genre->setGenre($form->getValue('genre'));

        if ($type == self::ADD) {
            $this->getEntityManager()->persist($genre);
        }
        $this->getEntityManager()->flush();

        return true;
    }

    /**
     * @param $id
     * @return Entities\Genres
     * @throws \Zend_Controller_Exception
     */
    public function getGenreById($id)
    {
        $genre = $this->getEntityManager()->getRepository('Entities\Genres')->findOneBy(array('id' => $id));

        if(!$genre instanceof Entities\Genres){
            throw new \Zend_Controller_Exception('Жанр не найдена', 404);
        }

        return $genre;
    }

    /**
     * Remove Genre
     * @param Entities\Genres $genre
     */
    public function doRemove(\Entities\Genres $genre)
    {
        $em = $this->getEntityManager();
        $em->remove($genre);
        $em->flush();
    }

    /**
     * @param int $page
     * @param array $filter
     * @return \Pagerfanta\Pagerfanta
     */
    public function getGenresList($page = 1, $filter = array())
    {
        $paginator = $this->getService('paginator');

        $dql = 'SELECT g FROM \Entities\Genres g ORDER BY g.id DESC';
        $query = $this->getEntityManager()
            ->createQuery($dql);

        // Create Paginator
        $pagerfanta = $paginator
            ->getORMpagerFanta($query, $page, self::COUNT_PER_PAGE);

        return $pagerfanta;
    }

    /**
     * @param Entities\Books $book
     * @param array $genres
     * @throws Exeption\Genre
     */
    public function editGenresByBook(\Entities\Books $book, $genres = array())
    {
        $currentGenres = $book->getGenres();

        //$genres = array_merge ($genres, array(111));

        if (count($genres) == 0) {
            throw new Genre_Exeption('Должен быть установлен минимум 1 жанр');
        }

        if($currentGenres->count() > 0){
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
            }else{
                throw new Genre_Exeption("Жанр, с идентификационным номером $genreId, не был найден");
            }
        }
    }
}