<?php

use Phalcon\Mvc\Controller;

class LoginController extends Controller
{
    public function indexAction() {
        $error = $this->request->get('error');

        $this->view->error = $error;
    }

    public function forgotAction() {
    }

    public function submitAction() {
        // get data from the URL
        $username = $this->request->get('username');
        $password = $this->request->get('password');

        // check if data is ok
        if($username=="salvi" && $password=="1234") {
            $this->response->redirect('/');
        } else {
            $this->response->redirect('/login/index?error=Wrong username or Password');
        }
    }
}
