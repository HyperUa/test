<?php

namespace Models;

/**
 * Class Processor
 * @package Models
 */
abstract class Processor
{
    const COUNT_PER_PAGE = 5;
    const EDIT  = 'Редактировать';
    const ADD   = 'Добавить';


    public abstract function createNewEntity();

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->getService('em');
    }

    /**
     * @param $service
     * @return mixed
     */
    protected function getService($service)
    {
        return $this->getServiceManager()->getService($service);
    }

    /**
     * @return \Task\ServiceManager
     */
    protected function getServiceManager()
    {
        return \Task\ServiceManager::getInstance();
    }
}