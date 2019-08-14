<?php
return [
    [
        'GET',
        '/products',
        [
            'uses' => 'App\\Controllers\\ProductsController@index'
        ]
    ],
    [
        'POST',
        '/users',
        [
            'uses' => 'App\\Controllers\\UsersController',
            'middleware' => null
        ]
    ],
    [
        'PATCH',
        '/users/{userId}',
        [
            'uses' => 'App\\Controllers\\UsersController',
            'middleware' => [
                'logged'
            ]
        ]
    ],
    [
        'POST',
        '/users/login',
        [
            'uses' => 'App\\Controllers\\UsersController@login'
        ]
    ]
];
