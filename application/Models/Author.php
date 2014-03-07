<?php

namespace Models;

use Entities\Authors;
use Forms\Author as Author_Form;


Class Author extends Processor
{
    const EDIT = 'Редактировать';
    const ADD = 'Добавить';


    public function createNewEntity()
    {
        return new Authors();
    }

    /**
     * @param Authors $genre
     * @param $type
     * @param null $options
     * @return Author_Form
     */
    public function getForm(Authors $genre, $type, $options = null)
    {
        $form = new Author_Form($options);

        if ($type == self::EDIT) {
            $form->populateEntity($genre);
        }
        $form->getElement('submit')->setLabel($type);

        return $form;
    }

    /**
     * @param Authors $genre
     * @param \Zend_Form $form
     * @param $type
     * @return bool
     */
    public function editAuthor(Authors $genre, \Zend_Form $form, $type)
    {
        $genre->setName($form->getValue('name'));

        if ($type == self::ADD) {
            $this->getEntityManager()->persist($genre);
        }
        $this->getEntityManager()->flush();

        return true;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Zend_Controller_Exception
     */
    public function getAuthorById($id)
    {
        $genre = $this->getEntityManager()->getRepository('Entities\Authors')->findOneBy(array('id' => $id));

        if(!$genre instanceof Authors){
            throw new \Zend_Controller_Exception('Автор не найден', 404);
        }

        return $genre;
    }

    public function doRemove(\Entities\Authors $author)
    {
        $em = $this->getEntityManager();
        $em->remove($author);
        $em->flush();
    }
}