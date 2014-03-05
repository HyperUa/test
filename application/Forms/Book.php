<?php

namespace Forms;

use Task\Form;
use Zend_Form_Element_Text;
use Zend_Form_Element_MultiCheckbox;
use Zend_Form_Element_Multiselect;
use Zend_Form_Element_File;
use Zend_Validate_NotEmpty;
use Zend_Validate_File_Extension;
use Zend_Validate_File_FilesSize;


class Book extends Form
{
    const ERR_EMPTY_TITLE = 'Введите название книги';
    const ERR_EMPTY_GENRE = 'Выберите как минимум 1 жанр';
    const ERR_EMPTY_AUTH = 'Выберите как минимум 1 автора';
    const ERR_EMPTY_FILE = 'Выберите книгу';
    const ERR_EXTENSION = 'Неверный формат файла(doc,pdf,txt только)';
    const ERR_TO_BIG = 'Загрузите файл меньшего размера(max 1MB)';

    public $elementDecorators = array(
        'ViewHelper',
        //'Errors',
        //array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class' => 'element')),
        array('Label'),
        array(
            array('row' => 'HtmlTag'),
            array(
                'tag' => 'div',
                'class' => 'element'
            )
        ),
    );


    public $type;
    public $book;

    public function __construct($options = null, \Entities\Books $book, $type = 'new')
    {
        $this->book = $book;
        $this->type = $type;

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
        // метод пост
        $this->setMethod('post');
        $upload_path = $this->getService('front_controller')->getParam('bootstrap')->getOption('upload_path');

        // Название
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

        // Жанры
        $genres = $this->getGenres();
        if (count($genres) > 0) {
            $inputGenre = new Zend_Form_Element_MultiCheckbox('genres');
            $inputGenre->setLabel('Жанр книги:')
                ->setRequired(true)
                ->setValidators(
                    array(
                        array(
                            'NotEmpty',
                            true,
                            array('messages' => array(Zend_Validate_NotEmpty::IS_EMPTY => self::ERR_EMPTY_GENRE))
                        ),
                    )
                );

            foreach ($genres as $genre) {
                $inputGenre->addMultiOption($genre->getId(), $genre->getGenre());
            }
        }

        // Авторы
        $authors = $this->getAuthors();
        if (count($authors) > 0) {
            $inputAuthor = new Zend_Form_Element_Multiselect('authors');
            $inputAuthor->setLabel('Автор книги:')
                ->setRequired(true)
                ->setValidators(
                    array(
                        array(
                            'NotEmpty',
                            true,
                            array('messages' => array(Zend_Validate_NotEmpty::IS_EMPTY => self::ERR_EMPTY_AUTH))
                        ),
                    )
                );

            foreach ($authors as $author) {
                $inputAuthor->addMultiOption($author->getId(), $author->getName());
            }
        }

        // Файл
        $file = new Zend_Form_Element_File('file');
        $file->setLabel('Выберите книгу')
            ->setDestination(BASE_PATH . $upload_path)
            ->setRequired(false)
            ->setMaxFileSize(1310720)
            ->setValidators(
                array(
                    array(
                        'NotEmpty',
                        true,
                        array(
                            'messages' => array(Zend_Validate_NotEmpty::IS_EMPTY => self::ERR_EMPTY_FILE)
                        )
                    ),
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

        $file_path = new Zend_Form_Element_Text('file_path');
        $file_path->setRequired(false)
            ->setDecorators(array(
                'label',
                array(
                    'HtmlTag',
                    array(
                        'tag' => 'div',
                        'class' => 'file_path',
                    )
                )
            ));

        if ($this->type !== 'new') {
            if ($this->book->getPath() != null) {
                $file_path->setLabel($this->book->getPath());
            }
        }


        $this->addElements(array($name, $inputGenre, $inputAuthor, $file, $file_path));

        $this->addDisplayGroup(array(
                'file',
                'file_path'
            ), 'elementGroup',
            array(
                'decorators' => array(
                    'FormElements',
                    array(
                        'HtmlTag',
                        array('tag' => 'div')
                    ),
                    'Fieldset'
                )
            ));

        $text = 'Изменить';
        if ($this->type == 'new') {
            $text = 'Добавить';
        }

        $this->addElement('submit', 'add', array(
            'label' => $text
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
        if ($genres->count() > 0) {
            foreach ($genres as $genre) {
                $data['genres'][] = $genre->getId();
            }
        }

        $authors = $entity->getAuthors();
        if ($authors->count() > 0) {
            foreach ($authors as $author) {
                $data['authors'][] = $author->getId();
            }
        }

        return parent::populate($data);
    }
}