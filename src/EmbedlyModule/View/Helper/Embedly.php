<?php

namespace EmbedlyModule\View\Helper;

use EmanueleMinotto\Embedly\Client;
use Zend\Form\View\Helper\AbstractHelper;

/**
 * {@inheritdoc}
 */
class Embedly extends AbstractHelper
{
    /**
     * @var \EmanueleMinotto\Embedly\Client
     */
    private $client;

    /**
     * This view helper requires the Embedly client.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Used only as a shortcut for the display method.
     *
     * @return string
     */
    public function __invoke($method, array $options)
    {
        return $this->client->display($method, $options);
    }
}
