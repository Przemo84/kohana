<?php
return [
    'title' => [
        'not_empty' => 'Title cannot be blank.',
        'regex' => 'Title can contain only letters and digits'
    ],
    'content' => [
        'not_empty' => 'Content cannot be blank.',
        'regex' => 'Content can contain only letters and digits'
    ],
    'username' => [
        'not_empty' => 'Username cannot be blank.',
        'regex' => 'Username can contain only lower and uppercase letters'
    ],
    'comment' => [
        'not_empty' => 'Comment cannot be blank.',
        'regex' => 'Comment can contain only lower and uppercase letters'
    ],
];