Embedly Module
==============

[![Build Status](https://img.shields.io/travis/EmanueleMinotto/EmbedlyModule.svg?style=flat)](https://travis-ci.org/EmanueleMinotto/EmbedlyModule)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/a0be99b7-f9fc-4744-ab19-cdc0c6aa9f26.svg?style=flat)](https://insight.sensiolabs.com/projects/a0be99b7-f9fc-4744-ab19-cdc0c6aa9f26)
[![Coverage Status](https://img.shields.io/coveralls/EmanueleMinotto/EmbedlyModule.svg?style=flat)](https://coveralls.io/r/EmanueleMinotto/EmbedlyModule)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/EmanueleMinotto/EmbedlyModule.svg?style=flat)](https://scrutinizer-ci.com/g/EmanueleMinotto/EmbedlyModule/)
[![Total Downloads](https://img.shields.io/packagist/dt/emanueleminotto/embedly-module.svg?style=flat)](https://packagist.org/packages/emanueleminotto/embedly-module)

An [embed.ly](http://embed.ly) module for Zend Framework 2 based on the [Embedly](https://github.com/EmanueleMinotto/Embedly) library.

API: [emanueleminotto.github.io/EmbedlyModule](http://emanueleminotto.github.io/EmbedlyModule/)

Installation
------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this module:

```bash
$ composer require emanueleminotto/embedly-module
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Usage
-----

```php
// EmanueleMinotto\Embedly\Client instance
$embedly = $this->getServiceLocator()->get('embedly');
```

Configuration
-------------

The module doesn't need a configuration to be used, but you can add an [API key](http://embed.ly/docs/api/authentication) and
a reference to a [Guzzle 5](http://docs.guzzlephp.org/en/latest/) client.

```php
return array(
    'embedly' => array(
        'api_key' => 'xxxxxxxx',
        'http_client' => 'guzzle_client_service_reference',
    ),
);
```
