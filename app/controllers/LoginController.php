<?php

use Phalcon\Mvc\Controller;


class LoginController extends Controller
{
    public function indexAction() 
    {
        $this->view->title = "Login";
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
            $obj = new stdClass();
            $obj->name = $user->name;
            $obj->email = $user->email;
            $obj->picture = $user->picture;
            $this->session->set('user', $obj);

            // redirect to the admin
            $this->response->redirect('/admin');
        } else {
            // redirect to login with error
            $this->response->redirect('/login/index?error=1');
        }
    }

    public function signupSubmitAction() 
    {
        $this->view->disable();

        if($this->request->isPost()) {
            $dataSent = $this->request->getPost();

            $auser = new User();
            $auser->name = $dataSent["name"];
            $auser->email = $dataSent["email"];
            $auser->password = md5($dataSent["password"]);
            $auser->picture = $dataSent["picture"];

            if(!$auser->picture){
                $auser->picture = "http://1.bp.blogspot.com/-Kudj45DvQSk/VlfWVCpeGMI/AAAAAAAACbw/qbDKhTo0TNQ/s000/no_image.jpg";
            }

            $savedSuccessfully = $auser->save();

            if($savedSuccessfully) {
                // create the session
                $obj = new stdClass();
                $obj->name = $auser->name;
                $obj->email = $auser->email;
                $obj->picture = $auser->picture;
                
                $this->session->set('user', $obj);
                
                // redirect to the admin
                $this->response->redirect('/admin');
            } else {
                $messages = $auser->getMessages();

                echo "Sorry, the following problems were generated: ";
                foreach ($messages as $message) {
                    echo "$message <br/>";
                }
            }
        } else {
            echo "The request method should be POST!";  
        }
    }

    public function logoutAction()
    {
        // close session
        $this->session->destroy();

        // redirect to login page
        $this->response->redirect('/login');
    }

    public function signupAction() 
    {
        $this->view->title = "Sign Up";
    }
}
