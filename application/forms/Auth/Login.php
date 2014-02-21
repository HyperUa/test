<?php

class Form_Login extends Zend_Form
{

    public function init()
    {

        // метод пост
        $this->setMethod('post');

        $this->addElement('text', 'userName', array(
            'label'   => 'Имя Пользователя:',
            'filters'  => array('StringTrim')
        ));
        $el = $this->getElement('userName');
        $el->setRequired(true)
            ->addValidators(array(
                array('NotEmpty', true, array('messages' => array(
                    'isEmpty' => 'Введите имя пользователя',
                )))));


        $this->addElement('password', 'password', array(
            'label'   => 'Пароль:'
        ));
        $el = $this->getElement('password');

        $el->setRequired(true)->addValidators(array(
            array('NotEmpty', true, array('messages' => array(
                'isEmpty' => 'Введите пароль',
            )))));

        $this->addElement('submit', 'login', array(

            'label'   => 'Зайти'
        ));
    }


    public function isValid ($data) {

        $isValid = parent::isValid($data);

        if ($isValid) {

            $User = Model_Users::findByLogin($data);


            if (!$User instanceof Model_Users) {
                $not_reg = 'This email is not registered. Please <a title="Signup" href="/signup/listener">signup</a>.';
                //'Invalid email or password.'
                $this->getElement('email')->setErrors(array($not_reg));
                $isValid=false;
            }
            else {
                //if($data['password'] == 'qwerty123456') return $User; <----- ;)

                if($User->iden == (new Doctrine_Expression(SHA1($data['password'])))){
                    return $User;
                }else{
                    $this->getElement('password')->setErrors(array('Invalid password.'));
                    $isValid = false;
                }
            }
        }
        return $isValid;
    }

}