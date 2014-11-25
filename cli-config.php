<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php');

$paths = array('module/Application/src/Application/Mapping');
$isDevMode = true;

$dbParams = array(
    'driver'=> 'pdo_sqlite',
    'path' => 'data/sample.db'
);

$config = Setup::createYAMLMetadataConfiguration($paths, $isDevMode);
$em = EntityManager::create($dbParams, $config);

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(
    array(
        'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
        'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
    )
);
