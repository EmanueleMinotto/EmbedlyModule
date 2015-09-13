<?php

return [
    // Embedly configuration
    'embedly' => [
        'api_key'     => null,
        'http_client' => 'GuzzleHttp\\Client',
    ],
    // Service Manager configuration
    'service_manager' => [
        'aliases' => [
            'embedly' => 'EmbedlyModule\\Service\\Client',
        ],
        'factories' => [
            'EmbedlyModule\\Service\\Client' => 'EmbedlyModule\\Service\\ClientFactory',
            'GuzzleHttp\\Client'             => function ($serviceManager) {
                return new \GuzzleHttp\Client();
            },
        ],
    ],
    // View support
    'view_helpers' => [
        'aliases' => [
            'embedlyDisplay' => 'EmbedlyModule\\View\\Helper\\EmbedlyHelper',
        ],
        'factories' => [
            'EmbedlyModule\\View\\Helper\\EmbedlyHelper' => 'EmbedlyModule\\View\\Helper\\EmbedlyHelperFactory',
        ],
    ],
];
