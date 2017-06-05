<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller {

	public function action_index()
	{
        $articleRepository = new Repository_Articles();
        $articles = $articleRepository->listAll();

	    $view = View::factory('listAll')
            ->set(['articles' => $articles]);
		$this->response->body($view);
	}

    public function action_show()
    {
        $zm ="gdgkldsjgasga";
        var_dump($zm);die;
        $this->response->body('hello, Michał!');
    }

}
