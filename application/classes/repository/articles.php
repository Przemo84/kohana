<?php

class Repository_Articles
{
    public function listAll($filter)
    {
        if($filter==null) {
            $results = Jelly::query('article')->select();
            $count = $results->count();

            return [$results, $count];
        }
        $results = Jelly::query('article')
            ->where('title','LIKE',"%$filter%")
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

    public function delete($id)
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

}