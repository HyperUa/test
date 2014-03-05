<?php

class Zend_View_Helper_Paginator extends Zend_View_Helper_Abstract
{
    protected $options = array(
        'previous_message'   => '<',
        'next_message'       => '>',
        'css_disabled_class' => 'disabled',
        'css_dots_class'     => 'dots',
        'css_current_class'  => 'current',
        'dots_text'          => '...',
        'container_template' => '<nav>%pages%</nav>',
        'page_template'      => '<a href="/%href%">%text%</a>',
        'span_template'      => '<span class="%class%">%text%</span>'
    );


    public function paginator(\Pagerfanta\PagerfantaInterface $pagerfanta, $options = array())
    {
        $this->setOptions($options);

        $routeGenerator = \Zend_Controller_Front::getInstance()->getRouter()->getCurrentRoute();

        $view = new Task\Tools\Paginator\View();
        $html = $view->render($pagerfanta, $routeGenerator, $this->options);

        return $html;
    }

    public function setOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }
}