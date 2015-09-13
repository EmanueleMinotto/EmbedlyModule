<?php

namespace EmbedlyModuleTest\Service;

use EmbedlyModule\Service\ClientFactory;
use PHPUnit_Framework_TestCase;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;

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
        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', [
            'modules' => [
                'EmbedlyModule',
            ],
            'module_listener_options' => [
                'config_glob_paths' => [],
                'module_paths'      => [],
            ],
        ]);
        $serviceManager->setFactory('ServiceListener', 'Zend\\Mvc\\Service\\ServiceListenerFactory');

        $moduleManager = $serviceManager->get('ModuleManager');
        $moduleManager->loadModules();

        $object = new ClientFactory();
        $service = $object->createService($serviceManager);

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
        $serviceManager = $this->getMockBuilder('Zend\\ServiceManager\\ServiceManager')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceManager->method('get')
            ->with('Config')
            ->willReturn($config);

        $object = new ClientFactory();
        $object->createService($serviceManager);
    }

    /**
     * @return array
     */
    public function wrongConfigurationDataProvider()
    {
        return [
            [
                [],
            ],
            [
                [
                    'embedly' => [],
                ],
            ],
            [
                [
                    'embedly' => [
                        'api_key' => null,
                    ],
                ],
            ],
            [
                [
                    'embedly' => [
                        'http_client' => null,
                    ],
                ],
            ],
            [
                [
                    'embedly' => [
                        'api_key' => 'correct',
                    ],
                ],
            ],
            [
                [
                    'embedly' => [
                        'api_key' => [],
                    ],
                ],
            ],
            [
                [
                    'embedly' => [
                        'http_client' => [],
                    ],
                ],
            ],
        ];
    }
}
