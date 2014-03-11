<?php

namespace Task\Tools\Paginator;

use Pagerfanta\View\Template\DefaultTemplate;


Class Template extends DefaultTemplate
{
    private $routeGenerator;

    protected function generateRoute($page)
    {
        return $this->routeGenerator->assemble(array('page' => $page));
    }

    public function setRouteGenerator($routeGenerator)
    {
        $this->routeGenerator = $routeGenerator;
    }
}