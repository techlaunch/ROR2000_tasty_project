<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction() 
    {
        $error = $this->request->get('error');
        $this->view->error = $error;
    }

    public function submitAction() 
    {
        // get data from the URL
        $email = $this->request->get('email');
        $password = md5($this->request->get('password'));

        // connect to the databas and pull the user
        $user = User::findFirst("email='$email' AND password='$password'");

        // check if data is ok
        if($user) {
            // create the session
            $userObj = new stdClass();
            $userObj->name = $user->name;
            $userObj->email = $user->email;
            $userObj->picture = $user->picture;
            $this->session->set('user', $userObj);

            // redirect to the admin
            $this->response->redirect('/admin');
        } else {
            // redirect to login with error
            $this->response->redirect('/login/index?error=1');
        }
    }

    public function logoutAction()
    {
        // close session
        $this->session->destroy();

        // redirect to login page
        $this->response->redirect('/login');
    }
}
