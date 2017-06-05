<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Web extends Controller {

	public function action_index()
	{


        $articles = "Articles";

	    $view = View::factory('pages/listAll')
            ->set(['articles' => $articles]);
		$this->response->body($view );
	}

    public function action_read()
    {
        $this->response->body('hello, Michał!');
    }


} // End Welcome
