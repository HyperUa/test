<?php

namespace Forms;

use Task\Form;
use Zend_Form_Element_Text;
use Zend_Form_Element_MultiCheckbox;
use Zend_Form_Element_Multiselect;
use Zend_Form_Element_Submit;
use Zend_Form_Element_File;
use Zend_Validate_File_Extension;
use Zend_Validate_File_FilesSize;
use Zend_Validate_NotEmpty;



class Book extends Form
{
    const ERR_EMPTY_TITLE = 'Введите название книги';
    const ERR_EMPTY_GENRE = 'Выберите как минимум 1 жанр';
    const ERR_EMPTY_AUTH = 'Выберите как минимум 1 автора';
    const ERR_EMPTY_FILE = 'Выберите книгу';
    const ERR_EXTENSION = 'Неверный формат файла(doc,pdf,txt только)';
    const ERR_TO_BIG = 'Загрузите файл меньшего размера(max 1MB)';


    public $type;
    public $book;

    public function __construct($options = null, \Entities\Books $book)
    {
        $this->book = $book;
        parent::__construct($options);
    }

    private function getGenres()
    {
        return $this->getEntityManager()->getRepository('\Entities\Genres')->findAll();
    }

    private function getAuthors()
    {
        return $this->getEntityManager()->getRepository('\Entities\Authors')->findAll();
    }


    public function init()
    {
        $upload_path = $this->getService('config')->getConfig('uploadpath')->books;


        $this
            ->setMethod('post')
            ->setName('book')// ->setDecorators($this->formDecorators)
        ;

        // Название
        $name = new Zend_Form_Element_Text('name');
        $name
            //->setRequired(true)
            ->setLabel('Название книги:')
            ->setDecorators($this->elementDecorators)
            ->setAttrib('class', 'col-lg-12')
            ->setErrorMessages(array(self::ERR_EMPTY_TITLE))
        ;

        // Жанры
        $genres = $this->getGenres();
        if (count($genres) > 0) {
            $inputGenre = new Zend_Form_Element_Multiselect('genres');
            $inputGenre->setLabel('Жанр книги:')
                //->setRequired(true)
                ->setAttrib('class', 'col-lg-12')
                ->setDecorators($this->elementDecorators)
                //->setErrorMessages(array(self::ERR_EMPTY_GENRE))
            ;

            foreach ($genres as $genre) {
                $inputGenre->addMultiOption($genre->getId(), $genre->getHTMLGenre());
            }
        }

        // Авторы
        $authors = $this->getAuthors();
        if (count($authors) > 0) {
            $inputAuthor = new Zend_Form_Element_Multiselect('authors');
            $inputAuthor->setLabel('Автор книги:')
                //->setRequired(true)
                ->setAttrib('class', 'col-lg-12')
                ->setDecorators($this->elementDecorators)
                //->setErrorMessages(array(self::ERR_EMPTY_AUTH))
            ;

            foreach ($authors as $author) {
                $inputAuthor->addMultiOption($author->getId(), $author->getHTMLName());
            }
        }

        // Файл
        $file = new Zend_Form_Element_File('file');
        $file->setLabel('Выберите книгу')
            ->setDestination(BASE_PATH . $upload_path)
            //->setRequired(false)
            ->setMaxFileSize(1310720)
            ->setDecorators($this->fileDecorator)
            ->setValidators(
                array(
                    array(
                        'extension',
                        true,
                        array(
                            'extention' => 'doc,pdf,txt',
                            'messages' => array(
                                Zend_Validate_File_Extension::NOT_FOUND =>
                                    self::ERR_EXTENSION,
                                Zend_Validate_File_Extension::FALSE_EXTENSION =>
                                    self::ERR_EXTENSION,
                            )
                        )
                    ),
                    array(
                        'FilesSize',
                        true,
                        array(
                            messages => array(
                                Zend_Validate_File_FilesSize::TOO_BIG =>
                                    self::ERR_TO_BIG
                            )
                        )
                    )
                )
            );

        $submit = new Zend_Form_Element_Submit('submit', 'Add');
        $submit->setDecorators($this->submiDecorator)
            ->setAttrib('class', 'styler col-lg-12');


        $this->addElements(array(
            $name,
            $inputGenre,
            $inputAuthor,
            $file,
            $submit
        ));
    }


    public function isValid($data)
    {

        $isValid = parent::isValid($data);

        if ($isValid) {

            $file = $this->getElement('file');
            if ($file->getValue() == null && $this->book->getPath() == null) {
                $file->setErrors(array(self::ERR_EMPTY_FILE));
                $isValid = false;
            }

        }
        return $isValid;
    }

    public function populateEntity($entity)
    {
        $data = $this->convertEntityToArray($entity);

        $genres = $entity->getGenres();
        if (count($genres) > 0) {
            foreach ($genres as $genre) {
                $data['genres'][] = $genre->getId();
            }
        }

        $authors = $entity->getAuthors();
        if (count($authors) > 0) {
            foreach ($authors as $author) {
                $data['authors'][] = $author->getId();
            }
        }

        return parent::populate($data);
    }
}