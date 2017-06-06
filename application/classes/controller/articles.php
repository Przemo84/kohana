<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller
{

    protected $id;

    public function before()
    {
        $this->id = $this->request->param('id');
    }

    public function action_index()
    {
        $articleRepository = new Repository_Articles();
        $articles = $articleRepository->listAll();;

        $view = View::factory('listAll')
            ->set(['articles' => $articles]);

        $this->response->body($view);
    }

    public function action_read()
    {
        $articleRepository = new Repository_Articles();
        $result = $articleRepository->show($this->id);

        $view = View::factory('read')
            ->set(['result' => $result]);

        $this->response->body($view);
    }

    public function action_delete()
    {
        $articleRepository = new Repository_Articles();
        $articleRepository->delete($this->id);

        $this->request->redirect('index.php/articles');
    }

    public function action_edit()
    {
        $articleRepository = new Repository_Articles();
        $article = $articleRepository->show($this->id);

        $view = View::factory('edit')
            ->set(['result' => $article]);

        $this->response->body($view);
    }

    public function action_store()
    {
        $articleRepository = new Repository_Articles();


        $articleRepository->update($this->id, $_POST['title'], $_POST['content']);

        $this->request->redirect('index.php/articles');
    }

    public function action_create()
    {
        $view = View::factory('create')
            ->set([]);

        $this->response->body($view);
    }

    public function action_creating()
    {
        $articleRepository = new Repository_Articles();

        $articleRepository->create($_POST['title'], $_POST['content']);

        $this->request->redirect('index.php/articles');
    }

}
