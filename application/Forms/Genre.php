<?php

namespace Forms;

use Task\Form;
use Zend_Form_Element_Text;
use Zend_Form_Element_Submit;


class Genre extends Form
{
    const ERR_EMPTY_TITLE = 'Введите название жанра';


    public function init()
    {
        $this
            ->setMethod('post')
            ->setName('genre')// ->setDecorators($this->formDecorators)
        ;

        // Название
        $name = new Zend_Form_Element_Text('genre');
        $name->setRequired(true)
            ->setLabel('Название жанра:')
            ->setDecorators($this->elementDecorators)
            ->setAttrib('class', 'col-lg-12')
            ->setErrorMessages(array(self::ERR_EMPTY_TITLE))
        ;

        $submit = new Zend_Form_Element_Submit('submit', 'Add');
        $submit->setDecorators($this->submiDecorator)
            ->setAttrib('class', 'styler col-lg-12')
        ;

        $this->addElements(array(
            $name,
            $submit
        ));
    }
}