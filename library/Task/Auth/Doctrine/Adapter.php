<?php

namespace Task\Auth\Doctrine;

use Zend_Auth_Adapter_Interface;
use Task\Manager;
use Zend_Auth_Result;


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
            $user = Manager::getInstance()
                ->getEntityManager()
                ->getRepository('Entities\Users')
                ->findOneBy(array('login' => $this->username));

            if ($user == NULL) {
                $result = new Zend_Auth_Result(
                    Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND,
                    null,
                    array('sorry, login ' . $this->username . ' was not found'));
            } else {
                if ($user->getPassword() != $this->password) {
                    $result = new Zend_Auth_Result(
                        Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID,
                        $user,
                        array(
                            'sorry, the password you entered was invalid for user ' .
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