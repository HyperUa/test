<?php

namespace Task\Tools\Doctrine;

use \Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use \Doctrine\ORM\QueryBuilder;

/**
 * Class Paginator
 * @package Task\Tools\Doctrine
 */
Class Paginator extends DoctrinePaginator
{
    const COUNT = 20;

    private $count;
    private $page;
    private $iterator;

    private $query;
    private $fetchJoinCollection = true;

    /**
     * Constructor.
     *
     * @param Query|QueryBuilder $query               A Doctrine ORM query or query builder.
     * @param boolean            $fetchJoinCollection Whether the query joins a collection (true by default).
     */
    public function __construct($query)
    {
        if ($query instanceof QueryBuilder) {
            $query = $query->getQuery();
        }

        $this->query = $query;
    }


    public function setItemCountPerPage($count)
    {
        $this->count = $count;
        return $this;
    }


    public function setCurrentPageNumber($page)
    {
        $this->page = $page;
        return $this;
    }


    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        if(is_null($this->iterator)){
            parent::__construct($this->query, $this->fetchJoinCollection);
            $this->iterator = parent::getIterator();
        }

        return $this->iterator;
    }


    public function getMaxPage()
    {
        $count = count($this->getIterator());
        return ceil($count / $this->getItemCount());
    }



    public function getPage()
    {
        if(is_null($this->page) || $this->page < 1){
            $this->page = 1;
        }
        return $this->page;
    }


    public function getItemCount()
    {
        if(is_null($this->count) || $this->count < 1){
            $this->count = self::COUNT;
        }

        return $this->count;
    }


}