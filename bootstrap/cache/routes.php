<?php
return [
    [
        'POST',
        '/auth/login',
        [
            'uses' => 'App\\Controllers\\AuthController@login'
        ]
    ],
    [
        'GET',
        '/products',
        [
            'uses' => 'App\\Controllers\\ProductsController',
            'middleware' => null
        ]
    ],
    [
        'POST',
        '/products',
        [
            'uses' => 'App\\Controllers\\ProductsController',
            'middleware' => [
                'scope:products:write'
            ]
        ]
    ],
    [
        'GET',
        '/products/{productId}',
        [
            'uses' => 'App\\Controllers\\ProductsController',
            'middleware' => null
        ]
    ],
    [
        'PATCH',
        '/products/{productId}',
        [
            'uses' => 'App\\Controllers\\ProductsController',
            'middleware' => [
                'scope:products:write'
            ]
        ]
    ],
    [
        'GET',
        '/products/{productId}/stocks',
        [
            'uses' => 'App\\Controllers\\ProductsController',
            'middleware' => null
        ]
    ],
    [
        'POST',
        '/stocks',
        [
            'uses' => 'App\\Controllers\\StocksController',
            'middleware' => [
                'stocks:write'
            ]
        ]
    ],
    [
        'PATCH',
        '/stocks/{stockId}',
        [
            'uses' => 'App\\Controllers\\StocksController',
            'middleware' => [
                'stocks:write'
            ]
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
