<?php

class Form_AddBook extends Task_Form
{
    const ERR_EMPTY_TITLE = 'Введите название книги';
    const ERR_EMPTY_GENRE = 'Выберите как минимум 1 жанр';
    const ERR_EMPTY_AUTH  = 'Выберите как минимум 1 автора';
    const ERR_EMPTY_FILE  = 'Выберите книгу';


    private function getGenres()
    {
        return Task_Service::getRepository('genres')->findAll();
    }

    private function getAuthors()
    {
        return Task_Service::getRepository('authors')->findAll();
    }

    public function init()
    {

        // метод пост
        $this->setMethod('post');

        $name = new Zend_Form_Element_Text('name');
        $name->setRequired(true)
            ->setLabel('Название книги:')
            ->setValidators(
                array(
                    array(
                        'NotEmpty',
                        true,
                        array('messages' => array(Zend_Validate_NotEmpty::IS_EMPTY => self::ERR_EMPTY_TITLE))
                    ),
                )
            );
        $this->addElement($name);


        $genres = $this->getGenres();
        if (count($genres) > 0) {
            $inputGenre = new Zend_Form_Element_MultiCheckbox('genres');

            foreach ($genres as $genre) {
                $inputGenre->addMultiOption($genre->getId(), $genre->getGenre());
            }

            $this->addElement($inputGenre);
        }

        $authors = $this->getAuthors();
        if (count($authors) > 0) {
            $inputAuthor = new Zend_Form_Element_Multiselect('authors');

            foreach ($authors as $author) {
                $inputAuthor->addMultiOption($author->getId(), $author->getName());
            }

            $this->addElement($inputAuthor);
        }
/*
        $file = new Zend_Form_Element_File('file');
        $file->setLabel('Добавить книгу')
            ->setDestination(BASE_PATH . '/data/uploads')
            ->setRequired(true)
            ->setValidators(
                array(
                    array(
                        'NotEmpty',
                        true,
                        array('messages' => array(Zend_Validate_NotEmpty::IS_EMPTY => self::ERR_EMPTY_FILE))
                    ),
                )
            );
        $this->addElement($file);
*/

        $this->addElement('submit', 'add', array(
            'label' => 'Добавить'
        ));

    }


    public function isValid($data)
    {

        $isValid = parent::isValid($data);

        if ($isValid) {

            $genres = $this->getElement('genres');
            $genreVal = $genres->getValue();

            if (count($genreVal) < 1) {
                $genres->setErrors(array(self::ERR_EMPTY_GENRE));
                $isValid = false;
            }

            $authors = $this->getElement('authors');
            $authVal = $authors->getValue();

            if (count($authVal) < 1) {
                $authors->setErrors(array(self::ERR_EMPTY_AUTH));
                $isValid = false;
            }

        }
        return $isValid;
    }

    public function populateEntity($entity){

        $data = $this->convertEntityToArray($entity);

        $genres = $entity->getGenre();
        if($genres->count() >0){
            foreach($genres as $genre){
                $data['genres'][] = $genre->getId();
            }
        }

        $authors = $entity->getAuthor();
        if($authors->count() >0){
            foreach($authors as $author){
                $data['authors'][] = $genre->getId();
            }
        }

        return parent::populate($data);
    }
}