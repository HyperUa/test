<?php

namespace Forms;

use Task\Form;
use Zend_Form_Element_Text;
use Zend_Form_Element_Submit;


class Author extends Form
{
    const ERR_EMPTY_TITLE = 'Введите имя автора';


    public function init()
    {
        $this
            ->setMethod('post')
            ->setName('author')// ->setDecorators($this->formDecorators)
        ;

        // Название
        $name = new Zend_Form_Element_Text('name');
        $name->setRequired(true)
            ->setLabel('Имя автора:')
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