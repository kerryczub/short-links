<?php

namespace Application;

use PHPUnit_Framework_TestCase;

/**
 * Class ModuleTest
 * @package Application
 */
class ModuleTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test getAutoloaderConfig().
     */
    public function testGetAutoloaderConfig()
    {
        $module = new Module();
        $autoloaderConfig = $module->getAutoloaderConfig();
        $this->assertInternalType('array', $autoloaderConfig);
    }

    /**
     * Test getConfig().
     */
    public function testGetConfig()
    {
        $module = new Module();
        $config = $module->getConfig();
        $this->assertInternalType('array', $config);
    }

    /**
     * Test getControllerConfig().
     */
    public function testGetControllerConfig()
    {
        $module = new Module();
        $controllerConfig = $module->getControllerConfig();
        $this->assertInternalType('array', $controllerConfig);
    }

    /**
     * Test getServiceConfig().
     */
    public function testGetServiceConfig()
    {
        $module = new Module();
        $serviceConfig = $module->getServiceConfig();
        $this->assertInternalType('array', $serviceConfig);
    }
}
