<?php

namespace Forms;

use Task\Form;
use Task\Manager;
use Zend_Form_Element_Text;
use Zend_Form_Element_Password;
use Zend_Form_Element_Submit;
use Zend_Validate_NotEmpty;
use Zend_Validate_StringLength;

class Auth extends Form
{
    const ERR_EMPTY_LOGIN = 'Введите Логин';
    const ERR_LOGIN_EXIST = 'Логин уже зарегестрирован';
    const EMPTY_PASSWORD = 'Пароль не должен быть пустым';
    const ERR_PASSWORD = 'Пароль не валидный(min 6)';
    const ERR_PASSWORD_MATCH = 'Пароли не совпадают';


    public function init()
    {
        $this
            ->setMethod('post')
            ->setName('signup')// ->setDecorators($this->formDecorators)
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
            ->addFilter('StringTrim')
            ->setAttrib('autocomplete', 'off')
            ->setAttrib('class', 'col-lg-12')
            ->setDecorators($this->elementDecorators)
            ->setValidators(array(
                array(
                    'NotEmpty',
                    false,
                    array('messages' => array(Zend_Validate_NotEmpty::IS_EMPTY => self::EMPTY_PASSWORD))
                ),
                array(
                    'StringLength',
                    false,
                    array(
                        'min' => 6,
                        'messages' => array(
                            Zend_Validate_StringLength::INVALID => self::ERR_PASSWORD,
                            Zend_Validate_StringLength::TOO_SHORT => self::ERR_PASSWORD
                        )
                    )
                )
            ))
        ;

        $pass2 = new Zend_Form_Element_Password('password2');
        $pass2->setRequired(true)
            ->setLabel('Повторите пароль:')
            ->addFilter('StringTrim')
            ->setAttrib('autocomplete', 'off')
            ->setAttrib('class', 'col-lg-12')
            ->setDecorators($this->elementDecorators)
            ->setErrorMessages(array('Введите повторный пароль'))
        ;

        $submit = new Zend_Form_Element_Submit('submit', 'Регистрация');
        $submit->setDecorators($this->submiDecorator)
            ->setAttrib('class', 'styler col-lg-12');


        $this->addElements(array(
            $login,
            $pass,
            $pass2,
            $submit
        ));
    }


    public function isValid($data)
    {
        $isValid = parent::isValid($data);
        $em = Manager::getInstance()->getEntityManager();

        $dublicate = $em->getRepository('Entities\Users')->findOneByLogin($data['login']);

        if ($dublicate !== null) {
            $this->getElement('login')->setErrors(array(self::ERR_LOGIN_EXIST));
            $isValid = false;
        }

        if ($data['password'] !== $data['password2']) {
            $this->getElement('password2')->setErrors(array(self::ERR_PASSWORD_MATCH));
            $isValid = false;
        }

        return $isValid;
    }

}