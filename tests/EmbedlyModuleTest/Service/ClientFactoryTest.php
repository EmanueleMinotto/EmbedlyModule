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
     * @var \EmbedlyModule\Service\ClientFactory
     */
    private $object;

    /**
     * @var \Zend\ServiceManager\ServiceManager
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $serviceManager;

    /**
     * Mock service manager.
     */
    public function setUp()
    {
        $this->serviceManager = $this->getMockBuilder('Zend\\ServiceManager\\ServiceManager')
            ->disableOriginalConstructor()
            ->getMock();

        $this->object = new ClientFactory();
    }

    /**
     * @covers ::createService
     */
    public function testCreateService()
    {
        $service = $this->object->createService($this->serviceManager);

        $this->assertInstanceOf('EmanueleMinotto\\Embedly\\Client', $service);
        $this->assertInstanceOf('GuzzleHttp\\ClientInterface', $service->getHttpClient());
    }

    /**
     * @covers ::createService
     * @dataProvider wrongConfigurationDataProvider
     * @expectedException PHPUnit_Framework_Error
     */
    public function testCreateServiceWithWrongConfiguration($config)
    {
        $this->serviceManager->method('get')
            ->with('Config')
            ->willReturn($config);

        $this->object->createService($this->serviceManager);
    }

    /**
     * @return array
     */
    public function wrongConfigurationDataProvider()
    {
        return array(
            array(),
            array(
                'embedly' => 'scalar',
            ),
            array(
                'embedly' => array(),
            ),
            array(
                'embedly' => array(
                    'api_key' => null,
                ),
            ),
            array(
                'embedly' => array(
                    'http_client' => null,
                ),
            ),
            array(
                'embedly' => array(
                    'api_key' => 'correct',
                ),
            ),
            array(
                'embedly' => array(
                    'api_key' => array(),
                ),
            ),
            array(
                'embedly' => array(
                    'http_client' => array(),
                ),
            ),
        );
    }
}
