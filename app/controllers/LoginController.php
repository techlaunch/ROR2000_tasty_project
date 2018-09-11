<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction() {
        $error = $this->request->get('error');
        $this->view->error = $error;
    }

    public function submitAction() {
        // get data from the URL
        $username = $this->request->get('username');
        $password = $this->request->get('password');

        // check if data is ok
        if($username=="salvi" && $password=="1234") {
            // create the session
            $user = new stdClass();
            $user->name = "Salvi";
            $user->email = "salvi@techlaunch.io";
            $user->picture = "http://www.cubaenmiami.com/wp-content/uploads/2016/08/salvi-pascual.jpg";
            $this->session->set('user', $user);

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
