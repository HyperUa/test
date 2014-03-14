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

        /** @var \Models\User $service */
        $model = $this->getModel('user');
        $form = $model->getLoginForm();

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                // Set values
                if($model->login($form->getValue('login'), $form->getValue('password'))){

                    if(($url = $this->getParam('url')) !== null){
                        $this->redirect(urldecode($url));
                    }
                    $this->goToHome();
                }else{
                    $this->addFlashMessage('Логин или пароль неверный');
                    $this->showFlashMessageWithoutReload();
                }
            }
        }

        $this->view->form = $form;
    }


    public function logoutAction()
    {
        /** @var \Models\User $service */
        $model = $this->getModel('user');
        $model->logout();

        $this->goToHome();
    }


    public function registrationAction()
    {
        /** @var \Models\User $service */
        $model = $this->getModel('user');
        $form  = $model->getAuthForm();

        // Check Valid
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                $user = $model->addUser($form);

                // Set values
                if($model->login($user->getLogin(), $user->getPassword(), false)){
                    $this->goToHome();
                }else{
                    $this->addFlashMessage('Что-то пошло не так! Попробуйте еще раз');
                    $this->showFlashMessageWithoutReload();
                }
            }
        }

        $this->view->form = $form;
    }
}