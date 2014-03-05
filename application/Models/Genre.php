<?php

namespace Models;

use Entities;


Class Genre extends Processor
{
    public function __construct(\Pimple $container)
    {
        parent::__construct($container);
    }

    public function createNewEntity()
    {
        return new Entities\Genres();
    }


}