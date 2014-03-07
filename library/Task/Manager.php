<?php

namespace Task;

class Manager
{
    protected static $service;

    protected function __construct()
    {}

    protected function __clone()
    {}

    public static function getInstance()
    {
        return new self;
    }

    /**
     * @return mixed
     * @throws \Zend_Controller_Exception
     */
    public function getServiceManager()
    {
        if(self::$service == null){
            $sm = \Zend_Registry::getInstance()->get('servicemanager');
            if(!$sm instanceof \Pimple){
                throw new \Zend_Controller_Exception('Service Manager not found', 500);
            }
            self::$service = $sm;
        }

        return self::$service;
    }

    /**
     * @param $service
     * @return mixed
     * @throws Zend_Exception
     */
    public function getService($service)
    {
        if (!$this->getServiceManager()->offsetExists($service)) {
            throw new Zend_Exception("Сервис $service отсутствует");
        }

        return $this->getServiceManager()->offsetGet($service);
    }


    /**
     * @return \Doctrine\Orm\EntityManager
     */
    public function getEntityManager()
    {
        return $this->getService('em');
    }
}