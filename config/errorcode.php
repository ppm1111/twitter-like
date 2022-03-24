<?php

return [
    // 'user' => [
    //     'code' => '01',
    //     'errorType' => [
    //         'USER_NOT_FOUND' => [
    //             'code' => '01',
    //             'template' => 'User id = {id} name = {name} does not exist',
    //         ],
    //         'USER_UNAUTHENTICATED' => [
    //             'code' => '02',
    //             'template' => 'User id does not authenticate',
    //         ],
    //     ],
    // ],
    'auth' => [
        'code' => '01',
        'errorType' => [
            'AUTH_PARAMETER_ERROR' => [
                'code' => '001',
                'template' => 'Email / Password is required.',
            ],
            'AUTH_FAILURE' => [
                'code' => '002',
                'template' => 'Invalid email or password.',
            ],
            'AUTH_API_FAILURE' => [
                'code' => '003',
                'template' => 'coss api login failure code: {code}',
            ],
        ],
    ],
    'jwt' => [
        'code' => '02',
        'errorType' => [
            'JWT_USER_NOT_FOUND' => [
                'code' => '001',
                'template' => '{message}',
            ],
            'JWT_TOKEN_EXPIRED' => [
                'code' => '002',
                'template' => '{message}',
            ],
            'JWT_UNAUTHORIZED' => [
                'code' => '003',
                'template' => '{message}',
            ],
            'JWT_ACTION_FORBIDEN' => [
                'code' => '004',
                'template' => 'This action is unauthorized',
            ],
        ],
    ],
];
