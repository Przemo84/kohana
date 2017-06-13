<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Api extends Controller
{
    protected $id;

    public function before()
    {
        parent::before();
        $this->id = $this->request->param('id');
    }

    public function action_index()
    {
        $pagination = Pagination::factory([
            'total_items' => 10,
            'items_per_page' => 10
        ])
            ->route_params([
                'directory' => Request::current()->directory(),
                'controller' => Request::current()->controller(),
                'action' => Request::current()->action(),
            ]);

        $articles = Jelly::query('article')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->select();


        $result = [];

        foreach ($articles as $article) {
            $result['items'][] = [
                'id' => $article->id,
                'content' => $article->content
            ];
        }

        $result['meta'] = [
            'items' => 2,
            'page' => 2,
            'count' => 20,
        ];

        $articles = json_encode($result);

        $this->response->body($articles);
        $this->response->status(200);
        $this->response->headers([
            'content-type' => 'application/json'
        ]);
    }

    public function action_read()
    {
        $articleModel = new Model_Article();
        $article = $articleModel->show($this->id);

        if ($article->id == null) {
            throw new HTTP_Exception_404();
        }

        $body['id'] = $article->id;
        $body['title'] = $article->title;
        $body['content'] = $article->content;

        $this->response->body(json_encode($body));
        $this->response->status(200);
    }


    public function action_delete()
    {
        $articleModel = new Model_Article();
        $articleModel->erase($this->id);
    }


    public function action_create()
    {
        if (HTTP_Request::POST) {
            $articleModel = new Model_Article();
            $bodyRequest = json_decode($this->request->body());

            $articleModel->create($bodyRequest->title, $bodyRequest->content);

            $this->response->status(201);
        }
    }

    public function action_update()
    {
        if (HTTP_Request::PUT) {
            $articleModel = new Model_Article();
            $article = $articleModel->show($this->id);

            if ($article->id == null) {
                throw new HTTP_Exception_404();
            }

            $bodyRequest = json_decode($this->request->body());

            $articleModel->update($this->id, $bodyRequest->title, $bodyRequest->content);

            $this->response->status(200);
        }
    }

}
