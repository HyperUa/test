<?php

namespace Models;


class Processor
{
    protected $container;

    protected function __construct(\Pimple $container) {
        $this->container = $container;
    }
/*
    abstract public function createNewEntity()
    {}
*/

    protected function doPersist(\Entity $entity, $withFlush = true)
    {
        $em = $this->getEntityManager();
        $em->persist($entity);
        if ($withFlush) {
            $em->flush();
        }
    }

    protected function doRemove(\Entity $entity)
    {
        $em = $this->getEntityManager();
        $em->remove($entity);
        $em->flush();
    }


    protected function getEntityManager()
    {
        if (!$this->container->offsetExists('em')) {
            throw new Zend_Exception('Doctrine Entity Manager отсутствует');
        }

        return $this->container->offsetGet('em');
    }

}