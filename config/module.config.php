<?php

return array(
    // Embedly configuration
    'embedly' => array(
        'api_key' => null,
        'http_client' => 'GuzzleHttp\\Client',
    ),
    // Service Manager configuration
    'service_manager' => array(
        'aliases' => array(
            'embedly' => 'EmbedlyModule\\Service\\Client',
        ),
        'factories' => array(
            'EmbedlyModule\\Service\\Client' => 'EmbedlyModule\\Service\\ClientFactory',
            'GuzzleHttp\\Client' => function ($serviceManager) {
                return new \GuzzleHttp\Client();
            },
        ),
    ),
    // View support
    'view_helpers' => array(
        'invokables' => array(
            'embedly' => 'EmbedlyModule\\View\\Helper\\Embedly',
        ),
    ),
);
