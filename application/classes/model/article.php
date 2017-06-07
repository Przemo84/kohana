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
            'comments' => Jelly::field('hasMany',['foreign' => 'comment']),
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