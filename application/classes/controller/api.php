<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Api extends Controller
{
    protected $id;

    public function before()
    {
        $this->id = $this->request->param('id');
        $this->limit = $this->request->query('limit');
    }
//    public function after()
//    {
//        $this->response->headers('Content-Type','application/json');
//        parent::after();
//    }

    public function action_read()
    {
        $articleModel = new Model_Article();
        $article = $articleModel->show($this->id);

        if (!$article) {
            throw new HTTP_Exception_404();
        }

        $body['id'] = $article->id;
        $body['title'] = $article->title;
        $body['content'] = $article->content;

        $this->response->body(json_encode($body));
    }

    public function action_index()
    {
        $articleModel = new Model_Article();
        $count = $articleModel->listAll()[1];
        $articles = $articleModel->listAll()[0];

//        var_dump($articles);die;

//        $pagination = Pagination::factory([
//            'total_items' => $count,
//            'items_per_page' =>  10
//        ])
//            ->route_params([
//                'directory' => Request::current()->directory(),
//                'controller' => Request::current()->controller(),
//                'action' => Request::current()->action(),
//            ]);
//
//
//        $articles = Jelly::query('article')
//            ->limit($pagination->items_per_page)
//            ->offset($pagination->offset)
//            ->select();

        $this->response->body(json_encode($articles));
    }

}
