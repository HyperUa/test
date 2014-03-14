<?php

class Zend_View_Helper_JsInit extends Zend_View_Helper_Abstract
{
    public function jsInit()
    {
        return \Task\JsInit::getInstance();
    }
}
