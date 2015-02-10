<?php

namespace EmbedlyModuleTest\Service;

use EmbedlyModule\View\Helper\Embedly;
use PHPUnit_Framework_TestCase;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;

/**
 * @author Emanuele Minotto <minottoemanuele@gmail.com>
 *
 * @coversDefaultClass \EmbedlyModule\View\Helper\Embedly
 */
class EmbedlyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__invoke
     * @dataProvider displayDataProvider
     */
    public function testCreateService($method, array $options = array())
    {
        if (!$_ENV['api_key']) {
            $this->markTestSkipped('API key is required.');
        }

        $options['url'] = 'http://placehold.it/50';

        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', array(
            'modules' => array(
                'EmbedlyModule',
            ),
            'module_listener_options' => array(
                'config_glob_paths' => array(),
                'module_paths' => array(),
            ),
        ));
        $serviceManager->setFactory('ServiceListener', 'Zend\\Mvc\\Service\\ServiceListenerFactory');

        $moduleManager = $serviceManager->get('ModuleManager');
        $moduleManager->loadModules();

        $viewHelperManager = $serviceManager->get('viewhelpermanager');
        $this->assertTrue($viewHelperManager->has('embedly'));

        // EmbedlyModule configuration override
        $serviceManager->setAllowOverride(true);
        $config = $serviceManager->get('Config');

        $config['embedly']['api_key'] = $_ENV['api_key'];

        $serviceManager->setService('Config', $config);
        // EmbedlyModule configuration override (END)

        $viewHelper = $viewHelperManager->get('embedly');
        $this->assertInstanceOf('EmbedlyModule\\View\\Helper\\Embedly', $viewHelper);

        $displayed = $viewHelper->__invoke($method, $options);
        $this->assertInternalType('string', $displayed);
    }

    /**
     * Data Provider for the display method.
     *
     * @return array
     */
    public function displayDataProvider()
    {
        return [
            [null, []],
            ['crop', [
                'height' => 50,
                'width' => 50,
            ]],
            ['resize', []],
            ['fill', [
                'color' => '000',
                'height' => 50,
                'width' => 50,
            ]],
        ];
    }
}
