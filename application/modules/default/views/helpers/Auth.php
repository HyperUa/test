<?php

class Zend_View_Helper_Auth extends Zend_View_Helper_Abstract
{
    public function auth()
    {
        return \Zend_Auth::getInstance();
    }
}