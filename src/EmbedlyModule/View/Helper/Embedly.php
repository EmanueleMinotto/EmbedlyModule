<?php

namespace EmbedlyModule\View\Helper;

use EmanueleMinotto\Embedly\Client;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\View\Helper\AbstractHelper;

/**
 * {@inheritdoc}
 */
class Embedly extends AbstractHelper implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    /**
     * Used only as a shortcut for the display method (based on global config).
     *
     * @param string $method Display method, can be crop, resize, fill or empty.
     * @param array  $params Request options.
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
        $serviceLocator = $this->getServiceLocator()->getServiceLocator();
        $client = $serviceLocator->get('embedly');

        $imageContent = $client->display($method, $options);

        return sprintf('data:image/png;base64,%s', base64_encode($imageContent));
    }
}
