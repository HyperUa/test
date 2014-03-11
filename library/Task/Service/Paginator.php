<?php

namespace Task\Service;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

/**
 * Class Paginator
 * @package Task\Service
 *
 * <code>
 *     $pager->getNbPages();
 *     $pager->getCurrentPageResults()
 *     $pager->haveToPaginate(); // whether the number of results if higher than the max per page
 *
 *     $pager->getCurrentPage();
 *     $pager->hasPreviousPage();
 *     $pager->getPreviousPage();
 *     $pager->hasNextPage();
 *     $pager->getNextPage();
 * </code>
 */
class Paginator
{
    protected $container;
    protected $pagerfanta;

    /**
     * @param \Pimple $container
     */
    public function __construct(\Pimple $container)
    {
        $this->container  = $container;
    }

    /**
     * @param \Doctrine\ORM\Query $query
     * @param null $page
     * @param null $pageSize
     * @return Pagerfanta
     */
    public function getORMpagerFanta(\Doctrine\ORM\Query $query, $page = null, $pageSize = null)
    {
        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);

        if(!is_null($pageSize)){
            $pagerfanta->setMaxPerPage($pageSize);
        }

        if(!is_null($page)){
            $pagerfanta->setCurrentPage($page);
        }

        return $pagerfanta;
    }
}