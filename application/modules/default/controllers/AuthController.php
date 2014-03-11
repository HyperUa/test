<?php

use \Task\Controller\Action;


class AuthController extends Action
{

    public function loginAction()
    {
        if(\Zend_Auth::getInstance()->hasIdentity()){
            $this->addFlashMessage('Вы уже залогинены');
            $this->goToHome();
        }

        $service = $this->getService('user');
        $form = $service->getLoginForm();

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                // Set values
                if($service->login($form->getValue('login'), $form->getValue('password'))){

                    if(($url = $this->getParam('url')) !== null){
                        $this->_redirect(urldecode($url));
                    }
                    $this->goToHome();
                }else{
                    $this->addFlashMessage('Логин или пароль неверный');
                }
            }
        }

        $this->view->form = $form;
    }


    public function logoutAction()
    {
        $service = $this->getService('user');
        $service->logout();

        $this->goToHome();
    }


    public function registrationAction()
    {
        $service = $this->getService('user');
        $form = $service->getAuthForm();

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                $user = $service->addUser($form);

                // Set values
                if($service->login($user->getLogin(), $user->getPassword(), false)){
                    $this->goToHome();
                }else{
                    $this->addFlashMessage('Что-то пошло не так!');
                }
            }
        }

        $this->view->form = $form;
    }
}