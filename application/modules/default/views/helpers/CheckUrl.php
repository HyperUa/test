<?php

class Zend_View_Helper_CheckUrl extends Zend_View_Helper_Abstract
{
    public function checkUrl($options = array())
    {
        $request = Zend_Controller_Front::getInstance()->getRequest();

        foreach ($options as $key => $option) {
            $key = ucfirst($key);

            if (method_exists($request, 'get' . $key . 'Name')) {
                if ($request->{'get' . $key . 'Name'}() != $option) {
                    return false;
                }
            }
        }

        return true;
    }
}

