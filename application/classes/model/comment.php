<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Comment extends Jelly_Model
{
    public static function initialize(Jelly_Meta $meta)
    {
        $meta->fields([
            'id' => Jelly::field('primary'),
            'article' => Jelly::field('belongsTo',[
                'column' => 'article_id',
                'foreign' => 'article'
                ]),
            'username' => Jelly::field('text'),
            'comment' => Jelly::field('text'),
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


}