<?php

use Phalcon\Mvc\Controller;

class AdminController extends Controller
{
    public function initialize()
    {
        // get the current page
        $this->view->page = basename($_SERVER['REQUEST_URI']);

        // do not allow anymimous users
        if ( ! $this->session->has('user')) {
            $this->response->redirect('/login');
        }

        // get the info for the person logged
        $this->view->user = $this->session->get('user');
    }

    public function indexAction() 
    {
        $this->response->redirect('/admin/recipes');
		$this->view->disable();
    }

    public function recipesAction()
    {
        // get the recipe from the database
        $recipes = Recipe::find();

        // passing information to the view
        $this->view->recipes = $recipes;
        $this->view->title = "List of recipes";
    }

    public function addAction() 
    {
        $this->view->title = "Add a recipe";
    }

    public function addSubmitAction() 
    {
        // get params from the url
        $name = $this->request->get('name');
        $time = $this->request->get('time');
        $ingredients = $this->request->get('ingredients');
        $instructions = $this->request->get('instructions');

        // add recipe to the database
        $recipe = new Recipe();
        $recipe->name = $name;
        $recipe->time = $time;
        $recipe->ingredients = $ingredients;
        $recipe->instructions = $instructions;
        $recipe->create();

        // redirect to the list of recipes
        $this->response->redirect('/admin/recipes');
		$this->view->disable();
    }
}
