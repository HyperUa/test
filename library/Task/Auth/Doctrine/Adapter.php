<?php

namespace Task\Auth\Doctrine;

use Task\ServiceManager;
use Zend_Auth_Adapter_Interface;
use Zend_Auth_Result;
use Zend_Auth_Adapter_Exception;
use Exception;


class Adapter implements Zend_Auth_Adapter_Interface
{
    private $username;
    private $password;

    /**
     * Sets username and password for authentication
     *
     * @param $username
     * @param $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authenticate()
    {
        $result = null;

        try {
            $user = ServiceManager::getInstance()
                ->getEntityManager()
                ->getRepository('Entities\Users')
                ->findOneBy(array('login' => $this->username));

            if ($user == NULL) {
                $result = new Zend_Auth_Result(
                    Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND,
                    null,
                    array('Логин ' . $this->username . ' не был найден'));
            } else {
                if ($user->getPassword() != $this->password) {
                    $result = new Zend_Auth_Result(
                        Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,
                        null,
                        array(
                            'Пароль неверный' .
                            $this->username
                        ));
                } else {
                    $result = new Zend_Auth_Result(
                        Zend_Auth_Result::SUCCESS,
                        $user->getId(),
                        array());
                }
            }
            return $result;
        } catch (Exception $e) {
            throw new Zend_Auth_Adapter_Exception($e->getMessage());
        }
    }
}