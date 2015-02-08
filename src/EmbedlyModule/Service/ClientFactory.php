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

        // If the "http_client" value is not null, check if
        // the service locator has the service and use it
        $httpClient = $config['http_client'];

        if (null !== $httpClient && $serviceLocator->has($httpClient)) {
            $httpClient = $serviceLocator->get($httpClient);
        }

        return new Client($config['api_key'], $httpClient);
    }
}
