<?php

namespace Task\Controller\Router;

use Zend_Controller_Router_Route_Abstract;


class MyRoute extends Zend_Controller_Router_Route_Abstract
{
    const URI_DELIMITER = '.';
    protected $_route = null;
    protected $_defaults = array();

    public function getVersion() {
        return 1;
    }

    public static function getInstance(\Zend_Config $config)
    {
        $defs = ($config->defaults instanceof \Zend_Config) ? $config->defaults->toArray() : array();
        return new self($config->route, $defs);
    }


    public function __construct($route, $defaults = array())
    {
        $this->_route = trim($route, self::URI_DELIMITER);
        $this->_defaults = (array) $defaults;
    }


    public function match($path, $partial = false)
    {
        if (($path = trim($path, parent::URI_DELIMITER)) == $this->_route) {

            $path = explode(self::URI_DELIMITER, $path);
            list($controller, $action) = $path;

            if((int)$controller != 0){
                switch ($controller){
                    case 2:
                        $controller = 'auth';
                        break;
                    case 3:
                        $controller = 'genres';
                        break;
                    case 1:
                    default:
                        $controller = 'index';
                        break;
                }
            }

            if($action == null){
                $action = $this->_defaults['action'];
            }
            $return = array('controller' => $controller, 'action' => $action);

            return $return;
        }

        return false;
    }


    public function assemble($data = array(), $reset = false, $encode = false, $partial = false)
    {
        return $this->_route;
    }

}