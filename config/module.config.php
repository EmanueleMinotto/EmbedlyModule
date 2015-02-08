<?php

return array(
    // Embedly configuration
    'embedly' => array(
        'api_key' => null,
        'http_client' => null,
    ),
    // Service Manager configuration
    'service_manager' => array(
        'aliases' => array(
            'embedly' => 'EmbedlyModule\\Service\\Client',
        ),
        'factories' => array(
            'EmbedlyModule\\Service\\Client' => 'EmbedlyModule\\Service\\ClientFactory',
        ),
    ),
);
