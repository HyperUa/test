<?php

class Form_Genre extends Task_Form
{
    const ERR_EMPTY_TITLE = 'Введите название жанра';


    public $elementDecorators = array(
        'ViewHelper',
        'Errors',
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

    public function __construct($options = null, $type = 'new')
    {
        $this->type = $type;
        parent::__construct($options);
    }


    public function init()
    {
        // метод пост
        $this->setMethod('post');


        // Название
        $name = new Zend_Form_Element_Text('genre');
        $name->setRequired(true)
            ->setLabel('Название жанра:')
            ->setDecorators($this->elementDecorators)
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


        $text = 'Изменить';
        if ($this->type == 'new') {
            $text = 'Добавить';
        }

        $this->addElement('submit', 'add', array(
            'label' => $text
        ));
    }
}