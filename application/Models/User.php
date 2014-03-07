<?php

namespace Models;

use Entities\Users;
use Task\Auth\Doctrine\Adapter as AuthAdapter;
use Forms\Login as Login_Form;
use Forms\Auth as Auth_Form;


Class User extends Processor
{
    protected $identityUser;

    public function createNewEntity()
    {
        return new Users();
    }


    public function getAuthAdapter(array $params)
    {
        return new AuthAdapter($params['login'], $params['password']);
    }

    /**
     * @param null $options
     * @return Login_Form
     */
    public function getLoginForm($options = null)
    {
        $form = new Login_Form($options);
        return $form;
    }

    /**
     * @param null $options
     * @return Login_Form
     */
    public function getAuthForm($options = null)
    {
        $form = new Auth_Form($options);
        return $form;
    }


    /**
     * @param $login
     * @param $password
     * @return bool
     */
    public function login($login, $password)
    {
        $adapter = $this->getAuthAdapter(
            array(
                'login'    => $login,
                'password' => $password
            )
        );

        $auth = \Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);

        if ($result->isValid()) {
            return true;
        }
        return false;
    }


    public function logout()
    {
        \Zend_Auth::getInstance()->clearIdentity();
    }

    public function addUser(\Zend_Form $form)
    {
        $user = $this->createNewEntity();
        $values = $form->getValues();

        $user->setLogin($values['login']);
        $user->setPassword($values['password']);

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    /**
     * @return \Entities\Users
     */
    public function getIdentityUser()
    {
        if($this->identityUser == null && \Zend_Auth::getInstance()->hasIdentity()){
            $authId = \Zend_Auth::getInstance()->getIdentity();
            $this->identityUser = $this->getEntityManager()->getRepository('Entities\Users')->find($authId);
        }

        return $this->identityUser;
    }

    /**
     * @param $id (int)
     * @return bool
     */
    public function checkUserAccess($id)
    {
        return ($user = $this->getIdentityUser()) instanceof \Entities\Users && $user->getId() == $id;
    }
}