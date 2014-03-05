<?php

namespace Task\Tools\Paginator;

use Pagerfanta\View\DefaultView;
use Zend_Controller_Router_Route_Interface;
use Pagerfanta\PagerfantaInterface;

Class View extends DefaultView
{
    protected $template;


    public function __construct()
    {
        $this->template = $this->createDefaultTemplate();
        parent::__construct($this->template);
    }

    public function createDefaultTemplate()
    {
        return new Template();
    }

    public function render(PagerfantaInterface $pagerfanta, $routeGenerator, array $options = array())
    {
        if(!$routeGenerator instanceof Zend_Controller_Router_Route_Interface){
            throw new Zend_Exception('RouteGenerator должен соответствовать Zend_Controller_Router_Route_Interface');
        }

        return parent::render($pagerfanta, $routeGenerator, $options);
    }
}