<?php

namespace Repository;

use Doctrine\ORM\EntityRepository;


/**
 * Class BookRepository
 * @package Repository
 */
class BookRepository extends EntityRepository
{
    public function getBook(){
       return 'a';
    }


/*
    public function getAllAdminUsers()
    {
        return $this->_em->createQuery('SELECT u FROM Model\User u WHERE u.status = "admin"')
            ->getResult();
    }*/
}