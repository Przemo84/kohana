<?php

class Repository_Articles
{
    public function listAll()
    {
        $results = DB::query(Database::SELECT, 'SELECT * FROM articles')->execute();
        return $results;
    }

    public function show($id)
    {

        return;
    }

}