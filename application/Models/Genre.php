<?php

namespace Models;

use Entities;
use Forms\Genre as Genre_Form;

/**
 * Class Genre
 * @package Models
 */
class Genre extends Processor
{
    const EDIT = 'Редактировать';
    const ADD = 'Добавить';


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

    public function doRemove(\Entities\Genres $genre)
    {
        $em = $this->getEntityManager();
        $em->remove($genre);
        $em->flush();
    }
}