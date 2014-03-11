<?php

namespace Repository;

use Doctrine\ORM\EntityRepository;


/**
 * Class BookRepository
 * @package Repository
 */
class BookRepository extends EntityRepository
{

    public function getBookByIdAndUser($book_id, $user_id)
    {
        return $this->_em->getRepository('Entities\Books')->findOneBy(array(
            'id'   => $book_id,
            'user' => $user_id
        ));
    }
}