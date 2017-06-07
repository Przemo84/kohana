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
        $articles = $articleRepository->listAll()[0];
        $count = $articleRepository->listAll()[1];

//        $pagination = Pagination::factory([
//            'total_items' => $count,
//            'items_per_page' => 10
//        ]);

        $view = View::factory('listAll')
            ->set(['articles' => $articles,
                'counts' => $count,
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
                'result' => $article,
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

    public function action_store()
    {
        /** @var TODO $validation */
//        $validation = Validation::factory($this->request->post());
//        $validation->rule('title', 'notEmpty',[':value','/^[a-z]/']);
//            ->rule('content', 'notEmpty')

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

    public function action_storeNewArticle()
    {
        $articleRepository = new Repository_Articles();

        $articleRepository->create($_POST['title'], $_POST['content']);

        $this->request->redirect('index.php/articles');
    }

    public function action_storeComment()
    {
        $commentRepository = new Repository_Comments();

        /** TODO posłać id DYNAMICZNIE!!!! */
        $commentRepository->createComment(38, $_POST['username'], $_POST['comment']);

        /** TODO posłać id DYNAMICZNIE!!!! */
        $this->request->redirect('index.php/articles/read/38');
    }

}
