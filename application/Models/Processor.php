<?php

namespace Models;


abstract class Processor
{
    public abstract function createNewEntity();


    protected function getEntityManager()
    {
        return \Task\Manager::getInstance()->getEntityManager();
    }


    protected function getService($service)
    {
        return \Task\Manager::getInstance()->getService($service);
    }

}