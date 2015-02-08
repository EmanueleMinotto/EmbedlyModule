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
    private $object;
    private $serviceManager;

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
        $this->assertInstanceOf(
            'EmanueleMinotto\\Embedly\\Client',
            $this->object->createService($this->serviceManager)
        );
    }

    public function testCreateGoodService()
    {
        $this->serviceManager->method('get')
            ->with('Config')
            ->willReturn(array(
                'embedly' => array(
                    'api_key' => "clear",
                ),
            ));
        $service = $this->object->createService($this->serviceManager);
        $this->assertInstanceOf("EmanueleMinotto\\Embedly\\Client", $service);
    }
}
