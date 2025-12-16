<?php
return [
    'path' => 'public/:model/:id/',
    'accept' => 'image/*,application/pdf',
    'route'=>[
        'middleware' => 'web',
        'prefix'=>'attachment',
    ],
    'options' => [
        'display' => [
            'action' => true,
            'incremental' => true,
            'id' => false,
            'model_type' => false,
            'model_id' => false,
            'title' => true,
            'name' => true,
            'size' => true,
            'type' => false,
            'extension' => true,
            'category' => true,
            'creator' => true,
            'description' => false
        ],
        'action'=> [
            'view' => true,
            'download' => true,
            'delete' => true,
        ]
    ],

];
