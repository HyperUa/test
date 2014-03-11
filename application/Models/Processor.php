<?php

namespace Models;


abstract class Processor
{
    public abstract function createNewEntity();


    protected function getEntityManager()
    {
        return $this->getService('em');
    }


    protected function getService($service)
    {
        return \Task\ServiceManager::getInstance()->getService($service);
    }

}