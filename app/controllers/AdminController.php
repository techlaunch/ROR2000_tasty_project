<?php

use Phalcon\Mvc\Controller;

class AdminController extends Controller
{
    public function initialize()
    {
        $this->view->page = basename($_SERVER['REQUEST_URI']);
    }

    public function indexAction() 
    {
        $this->response->redirect('admin/recipes');
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
        $this->response->redirect('admin/recipes');
		$this->view->disable();
    }
}
