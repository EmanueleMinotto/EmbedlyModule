<?php

namespace EmbedlyModuleTest\Service;

use EmbedlyModule\Service\ClientFactory;
use PHPUnit_Framework_TestCase;

/**
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 *
 * @coversDefaultClass \EmbedlyModule\Service\ClientFactory
 */
class ClientFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::createService
     */
    public function testCreateService()
    {
        $clientFactory = new ClientFactory();
        $serviceLocator = $this->getMock('Zend\\ServiceManager\\ServiceLocatorInterface');

        $this->assertInstanceOf(
            'EmanueleMinotto\\Embedly\\Client',
            $clientFactory->createService($serviceLocator)
        );
    }
}
