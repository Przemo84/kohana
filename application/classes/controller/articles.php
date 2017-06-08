<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller
{
    protected $id;

    public function before()
    {
        $this->id = $this->request->param('id');
        $this->limit = $this->request->query('limit');
        $this->filter = $this->request->query('filter');
    }

    public function action_index()
    {
        $articleRepository = new Repository_Articles();
        $count = $articleRepository->listAll($this->request->query('filter'))[1];

        $pagination = Pagination::factory([
            'total_items' => $count,
            'items_per_page' => $this->limit == 0 ? 10 : $this->limit
        ])
            ->route_params([
                'directory' => Request::current()->directory(),
                'controller' => Request::current()->controller(),
                'action' => Request::current()->action(),
            ]);

        $articles = Jelly::query('article')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->where('title', 'LIKE', "%$this->filter%")
            ->select();

        $view = View::factory('listAll')
            ->set(['articles' => $articles,
                'counts' => $count,
                'pagination' => $pagination
            ]);

        $this->response->body($view);
    }

    public function action_read()
    {
        $articleRepository = new Repository_Articles();
        $article = $articleRepository->show($this->id);

        $commentRepository = new Repository_Comments();
        $comments = $commentRepository->listComments($this->id);

        $view = View::factory('read')
            ->set([
                'article' => $article,
                'comments' => $comments
            ]);

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

    public function action_storeEditedArticle()
    {

//        $validation = Validation::factory($this->request->post());
//        $validation->rule('title', 'notEmpty')
//            ->rule('title', 'regex', [':value', '/^[a-zA-Z]++$/']);


        $articleRepository = new Repository_Articles();

        $articleRepository->update($this->id, $_POST['title'], $_POST['content']);

        $this->request->redirect('index.php/articles');
    }

    public function action_createNewArticle()
    {
        $view = View::factory('create')
            ->set([]);

        $this->response->body($view);
    }

    public function action_storeNewArticle()
    {
        $articleRepository = new Repository_Articles();

        $articleRepository->create($this->request->post('title'),  $this->request->post('content')    );

        $this->request->redirect('index.php/articles');
    }

    public function action_storeNewComment()
    {
        $commentRepository = new Repository_Comments();

        $commentRepository->createComment($this->id, $this->request->post('username'), $this->request->post('comment'));

        $this->request->redirect("index.php/articles/read/$this->id");
    }

}
