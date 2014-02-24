<?php

Class Task_Main
{

    public static function getAuth()
    {
        return Zend_Auth::getInstance();
    }


    public static function getBootstrap()
    {
        return Zend_Controller_Front::getInstance()->getParam('bootstrap');
    }


    public static function checkUrl($options = array()){

        foreach($options as $key => $option){
            $key = ucfirst($key);

            if(method_exists(self::getRequest(), 'get'.$key.'Name')){
                if(self::getRequest()->{'get'.$key.'Name'}() != $option){
                    return false;
                }
            }
        }

        return true;
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