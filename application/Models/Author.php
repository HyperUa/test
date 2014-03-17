<?php

namespace Models;

use Entities\Authors;
use Forms\Author as Author_Form;
use Models\Exeption\Author as Author_Exeption;


Class Author extends Processor
{

    /**
     * @return Authors
     */
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

    /**
     * Remove Author
     * @param Authors $author
     */
    public function doRemove(\Entities\Authors $author)
    {
        $em = $this->getEntityManager();
        $em->remove($author);
        $em->flush();
    }

    /**
     * @param int $page
     * @param array $filter
     * @return \Pagerfanta\Pagerfanta
     */
    public function getAuthorsList($page = 1, $filter = array())
    {
        $paginator = $this->getService('paginator');

        $dql = 'SELECT a FROM \Entities\Authors a ORDER BY a.id DESC';
        $query = $this->getEntityManager()
            ->createQuery($dql);

        // Create Paginator
        $pagerfanta = $paginator
            ->getORMpagerFanta($query, $page, self::COUNT_PER_PAGE);

        return $pagerfanta;
    }


    public function editAuthorsByBook(\Entities\Books $book, $authors = array())
    {
        //Removing Old Authors
        $currentAuthors = $book->getAuthors();

       // $authors = array_merge ($authors, array(111));

        if (count($authors) == 0) {
            throw new Author_Exeption('Должен быть выбран минимум 1 автор');
        }

        if ($currentAuthors->count() > 0) {
            foreach ($currentAuthors as $currentAuthor) {
                if (in_array($currentAuthor->getId(), $authors)) {
                    unset($authors[array_search($currentAuthor->getId(), $authors)]);
                } else {
                    $book->removeAuthor($currentAuthor);
                }
            }
        }

        //Write New Authors
        foreach ($authors as $authorId) {
            $authObj = $this->getEntityManager()->getRepository('Entities\Authors')->find($authorId);

            if (!$authObj instanceof \Entities\Authors) {
                throw new Author_Exeption("Автор, с идентификационным номером $authorId, не был найден");
            }else{
                $book->addAuthor($authObj);
            }
        }
    }
}