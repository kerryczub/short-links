<?php

// Set the location for the application.config.php file to be used in all controller tests.
define('APPLICATION_CONFIG_PATH', realpath(__DIR__ . '/../../../config/application.config.php'));

// Set the location for the vendor autoload.php file so we can use Composer's autoloader on library classes.
$vendorAutoloadFilePath = realpath(__DIR__ . '/../../../vendor/autoload.php');
if (!file_exists($vendorAutoloadFilePath)) {
    throw new \Exception('Dude, you have no vendor.');
}

// Load the Composer autoloader.
require $vendorAutoloadFilePath;

// Register this module's autoloader configuration.
require('../Module.php');
\Zend\Loader\AutoloaderFactory::factory((new \Application\Module())->getAutoloaderConfig());

// Go, baby, go!
