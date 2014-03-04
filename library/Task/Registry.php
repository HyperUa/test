<?php
/*
namespace Task;


Class Registry
{

    private $container;


    public function __construct()
    {

    }



    public static function getBootstrap()
    {
        return Zend_Controller_Front::getInstance()->getParam('bootstrap');
    }


    public static function checkUrl($options = array())
    {

        foreach ($options as $key => $option) {
            $key = ucfirst($key);

            if (method_exists(self::getRequest(), 'get' . $key . 'Name')) {
                if (self::getRequest()->{'get' . $key . 'Name'}() != $option) {
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


    public static function getRequest()
    {
        return Zend_Controller_Front::getInstance()->getRequest();
    }


    public static function getResponse()
    {
        return Zend_Controller_Front::getInstance()->getResponse();
    }


    public static function getOption($option = null)
    {
        if ($option !== null) {
            $options = explode('/', $option);

            $result = self::getBootstrap()->getOption($options[0]);
            unset($options[0]);

            if(count($options) == 0){
                return $result;
            }

            while (list ($key, $val) = each ($options) ){
                if(!isset($result[$val])) return null;
                $result = $result[$val];
            }
            return $result;
        }
        return self::getBootstrap()->getOptions();
    }
}

*/