<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Article extends Jelly_Model
{
    public static function initialize(Jelly_Meta $meta)
    {
        $meta->fields([
            'id' => Jelly::field('primary'),
            'title' => Jelly::field('text'),
            'content' => Jelly::field('text'),
            'comments' => Jelly::field('hasMany', ['foreign' => 'comment']),
            'updated_on' => Jelly::field('timestamp', [
                'format' => 'Y-m-d H:i:s',
                'auto_now_create' => TRUE,
                'auto_now_update' => TRUE
            ]),
            'created_on' => Jelly::field('timestamp', [
                'format' => 'Y-m-d H:i:s',
                'auto_now_create' => TRUE,
                'auto_now_update' => FALSE
            ])
        ]);
    }


    public function listAll($filter = null )
    {
        if ($filter == null) {
            $results = Jelly::query('article')->select();
            $count = $results->count();

            return [$results, $count];
        }
        $results = Jelly::query('article')
            ->where('title', 'LIKE', "%$filter%")
            ->select();
        $count = $results->count();

        return [$results, $count];
    }


    public function show($id)
    {
        $result = Jelly::query('article', $id)
            ->select();

        return $result;
    }


    public function erase($id)
    {
        Jelly::query('article', $id)
            ->select()
            ->delete();
    }


    public function update($id, $title, $content)
    {
        $article = Jelly::query('article', $id)->select();
        $article->title = $title;
        $article->content = $content;
        $article->save();
    }


    public function create($title, $content)
    {
        Jelly::factory('article')->set([
            'title' => $title,
            'content' => $content
        ])->save();
    }


    public function validateArticle($arr)
    {
        return $validation = Validation::factory($arr)
            ->rule('title', 'not_empty')
            ->rule('title', 'regex', [':value', '/^[a-zA-Z0-9\s]+$/'])
            ->rule('content', 'not_empty')
            ->rule('content', 'regex', [':value', '/^[a-zA-Z0-9\s]+$/']);
    }
}