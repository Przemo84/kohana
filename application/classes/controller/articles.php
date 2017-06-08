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
        $articleModel = new Model_Article();
        $count = $articleModel->listAll($this->request->query('filter'))[1];

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
        $articleRepository = new Model_Article();
        $article = $articleRepository->show($this->id);

        $commentModel = new Model_Comment();
        $comments = $commentModel->listComments($this->id);

        $view = View::factory('read')
            ->set([
                'article' => $article,
                'comments' => $comments
            ]);

        $this->response->body($view);
    }

    public function action_delete()
    {
        $articleRepository = new Model_Article();
        $articleRepository->erase($this->id);

        $this->request->redirect('index.php/articles');
    }

    public function action_edit()
    {
        $articleRepository = new Model_Article();
        $article = $articleRepository->show($this->id);

        $view = View::factory('edit')
            ->set(['result' => $article]);

        $this->response->body($view);
    }

    public function action_storeEditedArticle()
    {
        $articleRepository = new Model_Article();

        $articleRepository->update($this->id, $_POST['title'], $_POST['content']);

        $this->request->redirect('index.php/articles');
    }

    public function action_createNewArticle()
    {
        $modelArticle = Model::factory('article');

        $view = View::factory('create')
            ->bind('validator', $validator)
            ->bind('errors', $errors);
//            ->set([
//                'validator' => $validator,
//                'errors' => $errors
//            ]);

        if (Request::POST) {
            //added the arr::extract() method here to pull the keys that we want
            //to stop the user from adding their own post data
            $validator = $modelArticle->validate_article(arr::extract($_POST, array('title', 'content')));
            if ($validator->check()) {
                //validation passed, add to the db
                $modelArticle->create($validator);
                //clearing so it won't populate the form
                $validator = null;
            } else {
                //validation failed, get errors
                $errors = $validator->errors('errors');
            }
        }



        $this->response->body($view);
    }

    public function action_storeNewArticle()
    {
        $articleRepository = new Model_Article();

        $articleRepository->create($this->request->post('title'), $this->request->post('content'));

        $this->request->redirect('index.php/articles');
    }

    public function action_storeNewComment()
    {
        $commentRepository = new Model_Comment();

        $commentRepository->createComment($this->id, $this->request->post('username'), $this->request->post('comment'));

        $this->request->redirect("index.php/articles/read/$this->id");
    }

}
