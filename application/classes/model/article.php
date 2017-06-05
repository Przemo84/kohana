<?php
defined('SYSPATH') or die('No direct access allowed.');

class Model_Article extends Jelly_Model
{
    public static function initialize(Jelly_Meta $meta)
    {
        $meta->fields([
           'id' => Jelly::field('primary'),
            'title' => Jelly::field('text'),
            'content' => Jelly::field('text')
        ]);
    }


}