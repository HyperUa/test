<?php


class AuthController extends Task_Controller_Action
{


    public function loginAction()
    {
        //TODO: login;
        d('--');
        $form = $this->_getLoginForm();
/*
        $registry = Zend_Registry::getInstance();
        $this->_em = $registry->entitymanager;

        $testEntity = new Model_Users;
        $testEntity->setLogin('login');
        $testEntity->setPassword('23123');
        $this->_em->persist($testEntity);
        $this->_em->flush();



        $book = $this->_em->getRepository('Model_Users')->findOneBy(array(
            'id' => 1
        ));
        d($book);

*/
        if ($this->_request->isPost()) {

            $formData = $this->_request->getPost();

            if ($form->isValid($formData)) {

                $username = $form->getValue('userName');
                $password = $form->getValue('password');

                $User = $this->getEntityManager()->getRepository('Model_Users')->findOneBy(array(
                    'login' => $username,
                ));

           // d($this->getEntityManager()->getRepository('users'));



                d($result);


                $authAdapter->setIdentity($username)
                    ->setCredential(md5($password));

                $auth = Zend_Auth::getInstance();

                $result=$auth->authenticate($authAdapter);


                $auth  = Zend_Auth::getInstance();
                $authAdapter = $this->_getAuthAdapter($formData['userName'],$formData['password']);
                $result = $auth->authenticate($authAdapter);
                if (!$result->isValid()) {
                    // все неправильно
                    $form->setDescription('Неправильные имя или пароль');
                    $form->populate($formData);
                    $this->view->form = $form;
                    return $this->render('index');
                }else{

                    $currentUser = $authAdapter->getResultRowObject();
                    Zend_Auth::getInstance()->getStorage()->write( $currentUser);
                    return $this->_redirect('/');//залогинился,редирект на главную
                }

            } else {
                $form->populate($formData);
            }
        }

        $this->view->form = $form;
    }

    public function logoutAction()
    {
        //TODO: logout;
        $this->goToHome();
    }

    protected function _getLoginForm()
    {
        require_once APPLICATION_PATH . '/Forms/Auth/Login.php';
        return new Form_Login();
    }



}