<?php

class Task_Service
{
    private static $_entityManager;
    private static $_namespace = 'Entities';
    private static $_models;


    public static function getEntityManager(){

        if(self::$_entityManager == null){
            $registry = Zend_Registry::getInstance();

            self::$_entityManager = $registry->entitymanager;
        }
        return self::$_entityManager;
    }


    public static function getRepository($repository){

        $repository = ucfirst($repository);

        return self::getEntityManager()->getRepository(self::$_namespace.'\\'.$repository);
    }


    public static function getModel($model){

        $model = ucfirst($model);

        if(!self::$_models[$model]){
            $model = self::$_namespace.'\\'.$model;
            self::$_models[$model] = new $model;
        }

        return self::$_models[$model];
    }


    public static function getOption($opt = null){
        if($opt == null){
            return self::getBootstrap()->getOption($opt);
        }
        return self::getBootstrap()->getOptions();
    }


    public static function getBootstrap () {

        return Zend_Controller_Front::getInstance()->getParam('bootstrap');
    }

}