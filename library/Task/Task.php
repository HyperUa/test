<?php

Class Task
{

    public static function getAuth()
    {
        return Zend_Auth::getInstance();
    }


    public static function getBootstrap()
    {
        return Zend_Controller_Front::getInstance()->getParam('bootstrap');
    }


    public static function getConfig()
    {
        return self::getBootstrap()->getResource('config');
    }


    public static function getIdentity()
    {
        return self::getAuth()->hasIdentity() ? self::getAuth()->getIdentity() : false;
    }


    public static function getRequest()
    {
        return Zend_Controller_Front::getInstance()->getRequest();
    }


    public static function getResponse()
    {
        return Zend_Controller_Front::getInstance()->getResponse();
    }
}