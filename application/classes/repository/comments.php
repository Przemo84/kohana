<?php

class Repository_Comments
{
    public function listComments($id)
    {
        $results = Jelly::query('comments')
            ->where('article_id','=',$id)
            ->select();

        return $results;
    }

    public function createComment($id, $username, $comment)
    {
        Jelly::factory('comment')->set( [
            'article' => $id,
            'username' => $username,
            'comment' => $comment,
        ])
            ->save();
    }
}

