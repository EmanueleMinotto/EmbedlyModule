<?php

namespace EmbedlyModule\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * {@inheritdoc}
 */
class EmbedlyHelperFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $mainServiceLocator = $serviceLocator->getServiceLocator();

        return new EmbedlyHelper($mainServiceLocator->get('embedly'));
    }
}
