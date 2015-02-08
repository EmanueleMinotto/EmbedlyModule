<?php

namespace EmbedlyModuleTest\Service;

use EmbedlyModule\View\Helper\Embedly;
use EmanueleMinotto\Embedly\Client;
use PHPUnit_Framework_TestCase;

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

        $viewHelper = new Embedly(new Client($_ENV['api_key']));
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
