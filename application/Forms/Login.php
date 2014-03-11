<?php

namespace Forms;

use Task\Form;
use Zend_Form_Element_Text;
use Zend_Form_Element_Password;
use Zend_Form_Element_Submit;
use Zend_Form_Decorator_FormErrors;

class Login extends Form
{
    const ERR_EMPTY_LOGIN = 'Введите Логин';
    const ERR_EMPTY_PASS  = 'Введите Пароль';


    public function init()
    {
        $this
            ->setMethod('post')
            ->setName('login')// ->setDecorators($this->formDecorators)
        ;

        $login = new Zend_Form_Element_Text('login');
        $login->setRequired(true)
            ->setLabel('Логин:')
            ->setDecorators($this->elementDecorators)
            ->setAttrib('class', 'col-lg-12')
            ->setErrorMessages(array(self::ERR_EMPTY_LOGIN))
        ;

        $pass = new Zend_Form_Element_Password('password');
        $pass->setRequired(true)
            ->setLabel('Пароль:')
            ->setDecorators($this->elementDecorators)
            ->setAttrib('class', 'col-lg-12')
            ->setErrorMessages(array(self::ERR_EMPTY_PASS))
        ;

        $submit = new Zend_Form_Element_Submit('submit', 'Логин');
        $submit->setDecorators($this->submiDecorator)
            ->setAttrib('class', 'styler col-lg-12');


        $this->addElements(array(
            $login,
            $pass,
            $submit
        ));
    }
}