<?php

namespace EmbedlyModule\View\Helper;

use EmanueleMinotto\Embedly\Client;
use Zend\View\Helper\AbstractHelper;

/**
 * {@inheritdoc}
 */
class EmbedlyHelper extends AbstractHelper
{
    /**
     * Used embed.ly client.
     *
     * @var Client
     */
    private $client;

    /**
     * Constructor with required Embedly client.
     *
     * @param Client $client Required client.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Used only as a shortcut for the display method (based on global config).
     *
     * @param string $method  Display method, can be crop, resize, fill or empty.
     * @param array  $options Request options.
     *
     * @link http://embed.ly/docs/api/display/endpoints/1/display
     * @link http://embed.ly/docs/api/display/endpoints/1/display/crop
     * @link http://embed.ly/docs/api/display/endpoints/1/display/fill
     * @link http://embed.ly/docs/api/display/endpoints/1/display/resize
     *
     * @return string Base 64 encoded image URI.
     */
    public function __invoke($method, array $options)
    {
        $imageContent = $this->client->display($method, $options);

        return sprintf('data:image/png;base64,%s', base64_encode($imageContent));
    }
}
