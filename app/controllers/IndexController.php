<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function initialize()
    {
        // get the current page
        $this->view->page = basename($_SERVER['REQUEST_URI']);
        
    }

    public function indexAction() 
    {
        
    }

    

    public function searchSubmitAction() {
        // get data from the URL
        $search = $this->request->get('search');


        // search database
        

        // redirect to the index 
        
    }

   
}
