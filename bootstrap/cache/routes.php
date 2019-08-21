<?php
return [
    [
        'POST',
        '/addresses',
        [
            'uses' => 'App\\Controllers\\AddressesController',
            'middleware' => [
                'logged'
            ]
        ]
    ],
    [
        'PATCH',
        '/addresses/{addressId}',
        [
            'uses' => 'App\\Controllers\\AddressesController',
            'middleware' => [
                'logged'
            ]
        ]
    ],
    [
        'POST',
        '/auth/login',
        [
            'uses' => 'App\\Controllers\\AuthController@login'
        ]
    ],
    [
        'POST',
        '/cart/check',
        [
            'uses' => 'App\\Controllers\\CartController@check'
        ]
    ],
    [
        'POST',
        '/cart/initialize',
        [
            'uses' => 'App\\Controllers\\CartController@initialize'
        ]
    ],
    [
        'POST',
        '/cart/update/{paymentIntentId}',
        [
            'uses' => 'App\\Controllers\\CartController@update'
        ]
    ],
    [
        'POST',
        '/orders/webhook',
        [
            'uses' => 'App\\Controllers\\OrdersController@webhook'
        ]
    ],
    [
        'PATCH',
        '/orders/{orderId}',
        [
            'uses' => 'App\\Controllers\\OrdersController',
            'middleware' => [
                'scope:orders:write'
            ]
        ]
    ],
    [
        'GET',
        '/orders/{orderId}/stocks',
        [
            'uses' => 'App\\Controllers\\OrdersController',
            'middleware' => [
                'logged'
            ]
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
        'GET',
        '/users/{userId}',
        [
            'uses' => 'App\\Controllers\\UsersController',
            'middleware' => [
                'logged'
            ]
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
        'GET',
        '/users/{userId}/addresses',
        [
            'uses' => 'App\\Controllers\\UsersController',
            'middleware' => [
                'logged'
            ]
        ]
    ],
    [
        'GET',
        '/users/{userId}/orders',
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
