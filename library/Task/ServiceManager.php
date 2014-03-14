<?php

namespace Task;

class ServiceManager
{
    private static $service;

    private function __construct()
    {}

    private function __clone()
    {}

    public static function getInstance()
    {
        return new self;
    }

    public static function setServiceManager(\Pimple $sm)
    {
        if(self::$service == null)
        {
            self::$service = $sm;
        }
    }

    /**
     * @return mixed
     * @throws \Zend_Exception
     */
    public function getServiceManager()
    {
        if(self::$service == null){
            $sm = \Zend_Registry::getInstance()->get('servicemanager');
            if(!$sm instanceof \Pimple){
                throw new \Zend_Exception('Service Manager не найден');
            }
            self::$service = $sm;
        }

        return self::$service;
    }

    /**
     * @param $service
     * @return mixed
     * @throws \Zend_Exception
     */
    public function getService($service)
    {
        if (!$this->getServiceManager()->offsetExists($service)) {
            throw new \Zend_Exception("Сервис $service отсутствует");
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

    /**
     * @return \Task\ConfigManager
     */
    public function getConfigManager()
    {
        return $this->getService('config');
    }

    /**
     * @return \Task\ModelManager
     */
    public function getModelManager()
    {
        return $this->getService('modelManager');
    }


    public function getModel($model)
    {
        return $this->getModelManager()->getModel($model);
    }
}