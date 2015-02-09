<?php

namespace EmbedlyModule\Service;

use EmanueleMinotto\Embedly\Client;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * {@inheritdoc}
 */
class ClientFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $config = $config['embedly'];

        return new Client(
            $config['api_key'],
            $serviceLocator->get($config['http_client'])
        );
    }
}
