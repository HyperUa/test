<?php

namespace Models;

use Models\ModelAbstract;
use Entities\Users;


Class User extends ModelAbstract
{
    public function __construct(\Pimple $container)
    {
        parent::__construct($container);
    }


    public function createNewEntity()
    {
        return new Users();
    }
}