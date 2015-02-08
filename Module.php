<?php

namespace EmbedlyModule;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * {@inheritdoc}
 */
class Module implements ConfigProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        return require __DIR__.'/config/module.config.php';
    }
}
