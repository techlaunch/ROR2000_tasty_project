<?php

use Phalcon\Mvc\Controller;

class AdminController extends Controller
{
    public function initialize()
    {
        // get the current page
        $this->view->page = basename($_SERVER['REQUEST_URI']);

        // get the info for the person logged
        $this->view->user = $this->session->get('user');

        // do not allow anymimous users
        if ( ! $this->session->has('user')) {
            $this->response->redirect('/login');
        }
    }

    public function indexAction() 
    {
        $this->response->redirect('/admin/recipes');
		$this->view->disable();
    }

    public function recipesAction() 
    {
        $this->view->title = "List of recipes";
    }

    public function addAction() 
    {
        $this->view->title = "Add a recipe";
    }

    public function addSubmitAction() 
    {
        // TODO add recipe to the database
        // ...

        // redirect to the list of recipes
        $this->response->redirect('/admin/recipes');
		$this->view->disable();
    }
}
