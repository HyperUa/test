<?php

namespace Task\Controller\Plugins;

use Zend_Controller_Action_HelperBroker;
use Zend_Controller_Plugin_Abstract;
use Zend_Controller_Request_Abstract;
use Zend_Controller_Front;

use Zend_Auth;

/**
 * Class Auth
 * @package Task\Controller\Plugins
 */
class Auth extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        /**
         * Check if Authorize or Auth Controller
         * Check allowed Url for Non regist users
         */
        if(!Zend_Auth::getInstance()->hasIdentity() && !$this->checkAllowedUrls($request)){

            //Check if Action Exist
            if($this->actionExists($request)){
                $redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
                //$params = array('url' => urlencode($request->getRequestUri()));
                $params = array();
                $redirector->gotoRoute($params, 'login');
            }
        }

        return;
    }


    public function checkAllowedUrls(Zend_Controller_Request_Abstract $request)
    {
        //Get Allowed Conf
        $frontController = Zend_Controller_Front::getInstance();
        $config          = $frontController->getParam("bootstrap")->getOption('allowedurl');

        if(!is_array($config)) {
            return false;
        }

        $controllerName  = $request->getControllerName();
        $actionName      = $request->getActionName();

        $currents = array(
            'all'        => $controllerName. ':' . $actionName,
            'controller' => $controllerName. ':*',
            'action'     =>  '*:' . $actionName,
        );
        foreach($currents as $current){
            if(in_array($current, $config)){
                return true;
            }
        }

        return false;
    }


    private function actionExists($request)
    {
        $dispatcher = Zend_Controller_Front::getInstance()->getDispatcher();

        // Check controller
        if (!$dispatcher->isDispatchable($request)) {
            return false;
        }

        // Check action
        $controllerClassName = $dispatcher->formatControllerName($request->getControllerName());

        $controllerClassFile = $controllerClassName . '.php';
        if ($request->getModuleName() != $dispatcher->getDefaultModule()) {
            $controllerClassName = ucfirst($request->getModuleName()) . '_' . $controllerClassName;
        }
        try {
            require_once 'Zend/Loader.php';
            \Zend_Loader::loadFile($controllerClassFile, $dispatcher->getControllerDirectory($request->getModuleName()));
            $actionMethodName = $dispatcher->formatActionName($request->getActionName());
            if (@in_array($actionMethodName, get_class_methods($controllerClassName))) {
                return true;
            }
            return false;
        } catch(Exception $e) {
            return false;
        }
    }
}