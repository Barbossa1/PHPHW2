<?php

return [
    'name' => 'Интернет Магазин',
    'defaultController' => 'good',

    'components' => [
        'db' => [
            'class' => \App\services\DB::class,
            'config' => [
                'driver' =>  'mysql',
                'host' =>  'localhost',
                'dbname' =>  'shop',
                'charset' =>  'UTF8',
                'user' => 'root',
                'password' => 'root'
            ]
        ],
        'request' => [
            'class' => \App\services\Request::class,
        ],
        'renderer' => [
            'class' => \App\services\TwigRendererServices::class,
        ],
        'goodRepository' => [
            'class' => \App\repositories\GoodRepository::class,
        ],
        'userRepository' => [
            'class' => \App\repositories\UserRepository::class,
        ],
        'goodService' => [
            'class' => \App\services\GoodService::class,
        ],
        'authService' => [
            'class' => \App\services\AuthService::class,
        ],
        'paginatorServices' => [
            'class' => \App\services\PaginatorServices::class,
        ],
    ],
];