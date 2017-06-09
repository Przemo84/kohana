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
        $articleModel = new Model_Article();
        $article = $articleModel->show($this->id);

        $commentModel = new Model_Comment();
        $comments = $commentModel->listComments($this->id);

        if (Request::POST) {
            $validator = $commentModel->validateComment(arr::extract($_POST, ['username', 'comment']));

            if ($validator->check()) {
                $commentModel->createComment($this->id, $validator['username'], $validator['comment']);
                $validator = null;
                $this->request->redirect("index.php/articles/read/$this->id");
            } else {
                $errors = $validator->errors('errors');
            }
        }

        $view = View::factory('read')
            ->bind('article', $article)
            ->bind('comments', $comments)
            ->bind('validator', $validator)
            ->bind('errors', $errors);

        $this->response->body($view);
    }

    public function action_delete()
    {
        $articleModel = new Model_Article();
        $articleModel->erase($this->id);

        $this->request->redirect('index.php/articles');
    }

    public function action_edit()
    {
        $articleModel = new Model_Article();
        $article = $articleModel->show($this->id);

        if (Request::POST) {
            $validator = $articleModel->validateArticle(arr::extract($_POST, ['title', 'content']));

            if ($validator->check()) {
                $articleModel->update($this->id, $validator['title'], $validator['content']);
                $validator = null;
                $this->request->redirect('index.php/articles');

            } else {
                $errors = $validator->errors('errors');
            }
        }

        $view = View::factory('edit')
            ->bind('result', $article)
            ->bind('errors', $errors)
            ->bind('validator', $validator);

        $this->response->body($view);
    }

    public function action_storeEditedArticle()
    {
        $articleModel = new Model_Article();

        $articleModel->update($this->id, $_POST['title'], $_POST['content']);

        $this->request->redirect('index.php/articles');
    }

    public function action_createNewArticle()
    {
        $articleModel = new Model_Article();

        if (Request::POST) {
            $validator = $articleModel->validateArticle(arr::extract($_POST, ['title', 'content']));

            if ($validator->check()) {

                $articleModel->create($validator['title'], $validator['content']);

                $validator = null;

                $this->request->redirect('index.php/articles');
            } else {
                $errors = $validator->errors('errors');
            }
        }

        $view = View::factory('create')
            ->bind('validator', $validator)
            ->bind('errors', $errors);

        $this->response->body($view);
    }

    public function action_storeNewArticle()
    {
        $articleModel = new Model_Article();

        $articleModel->create($this->request->post('title'), $this->request->post('content'));

        $this->request->redirect('index.php/articles');
    }

    public function action_storeNewComment()
    {
        $commentRepository = new Model_Comment();

        $commentRepository->createComment($this->id, $this->request->post('username'), $this->request->post('comment'));

        $this->request->redirect("index.php/articles/read/$this->id");
    }

}
