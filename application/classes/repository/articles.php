<?php

class Repository_Articles
{
    public function listAll()
    {
        $results = DB::query(Database::SELECT, 'SELECT * FROM articles')
            ->execute();
        return $results;
    }

    public function show($id)
    {
        $result = DB::select()
            ->from('articles')
            ->where('id', '=', $id)
            ->execute();
        return $result;
    }

    public function delete($id)
    {
        DB::delete('articles')
            ->where('id', '=', $id)
            ->execute();
    }

    public function update($id, $title, $content)
    {
        DB::update('articles')
            ->set([
                'title' => $title,
                'content' => $content,
            ])
            ->where('id', '=', $id)
            ->execute();
    }

    public function create($title, $content)
    {
        DB::insert('articles', ['title', 'content'])
            ->values([$title, $content])
            ->execute();
    }

}